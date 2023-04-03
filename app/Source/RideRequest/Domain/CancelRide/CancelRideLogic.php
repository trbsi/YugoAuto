<?php

namespace App\Source\RideRequest\Domain\CancelRide;

use App\Models\RideRequest;
use App\Source\RideRequest\Domain\NotifyUser\NotifyUserLogic;
use App\Source\RideRequest\Infra\CancelRide\Services\CancelRideService;
use App\Source\RideRequest\Infra\CancelRide\Services\RemoveRatingService;
use App\Source\RideRequest\Infra\CancelRide\Specifications\CanCancelRideSpecification;
use Exception;

class CancelRideLogic
{
    public function __construct(
        private CanCancelRideSpecification $canCancelRideSpecification,
        private CancelRideService $cancelRideService,
        private readonly RemoveRatingService $removeRatingService
    ) {
    }

    public function cancel(
        int $authUserId,
        int $passengerId,
        int $rideId
    ): RideRequest {
        if (!$this->canCancelRideSpecification->satisfiedBy($authUserId, $passengerId, $rideId)) {
            throw new Exception('You cannot cancel this ride');
        }

        $rideRequest = $this->cancelRideService->cancel(
            passengerId: $passengerId,
            rideId: $rideId,
            authUserId: $authUserId
        );

        $this->removeRatingService->remove($rideRequest->ride, $passengerId);

        NotifyUserLogic::sendCancellationNotification($rideRequest, $authUserId);

        return $rideRequest;
    }
}
