<?php

namespace App\Source\RideRequest\Domain\CancelRide;

use App\Models\RideRequest;
use App\Source\RideRequest\Domain\NotifyUser\NotifyUserLogic;
use App\Source\RideRequest\Infra\CancelRide\Services\CancelRideService;
use App\Source\RideRequest\Infra\CancelRide\Services\RatingService;
use App\Source\RideRequest\Infra\CancelRide\Specifications\CanCancelRideSpecification;
use App\Source\RideRequest\Infra\CancelRide\Specifications\IsLateCancellationSpecification;
use Exception;

class CancelRideLogic
{
    public function __construct(
        private readonly CanCancelRideSpecification $canCancelRideSpecification,
        private readonly CancelRideService $cancelRideService,
        private readonly RatingService $ratingService,
        private readonly IsLateCancellationSpecification $isLateCancellationSpecification
    ) {
    }

    public function cancel(
        int $authUserId,
        int $rideRequestId
    ): RideRequest {
        $rideRequest = RideRequest::findOrFail($rideRequestId);
        $ride = $rideRequest->ride;

        $canCancel = $this->canCancelRideSpecification->satisfiedBy(
            authUserId: $authUserId,
            rideRequest: $rideRequest,
            ride: $ride
        );

        if (!$canCancel) {
            throw new Exception('You cannot cancel this ride');
        }

        $rideRequest = $this->cancelRideService->cancel(
            rideRequest: $rideRequest,
            authUserId: $authUserId
        );

        if ($this->isLateCancellationSpecification->isSatisfied($ride)) {
            $this->ratingService->setLateCancellationRating($rideRequest);
            $this->cancelRideService->increaseLastMinuteCancellation($authUserId);
        } else {
            $this->ratingService->remove($rideRequest);
            $this->cancelRideService->decreaseRidesCount($rideRequest);
        }

        NotifyUserLogic::sendCancellationNotification($rideRequest, $authUserId);

        return $rideRequest;
    }
}
