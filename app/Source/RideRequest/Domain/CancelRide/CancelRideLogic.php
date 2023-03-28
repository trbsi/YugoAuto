<?php

namespace App\Source\RideRequest\Domain\CancelRide;

use App\Source\RideRequest\Domain\SendEmail\SendEmailLogic;
use App\Source\RideRequest\Infra\CancelRide\Services\CancelRideService;
use App\Source\RideRequest\Infra\CancelRide\Specifications\CanCancelRideSpecification;
use Exception;

class CancelRideLogic
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

        $rideRequest = $this->cancelRideService->cancel($passengerId, $rideId);
        SendEmailLogic::sendEmailToPassenger($rideRequest);
    }
}
