<?php

namespace App\Source\RideRequest\Domain\CancelRide;

use App\Source\RideRequest\Infra\CancelRide\Services\CancelRideService;
use App\Source\RideRequest\Infra\CancelRide\Specifications\CanCancelRideSpecification;
use Exception;

class CancelRideBusinessLogic
{
    public function __construct(
        private CanCancelRideSpecification $canCancelRideSpecification,
        private CancelRideService $cancelRideService
    ) {
    }

    public function cancel(
        int $authUserId,
        int $passengerId,
        int $rideId
    ): void {
        if (!$this->canCancelRideSpecification->satisfiedBy($authUserId, $passengerId, $rideId)) {
            throw new Exception('You cannot cancel this ride');
        }

        $this->cancelRideService->cancel($passengerId, $rideId);
        //TODO send email
    }
}
