<?php

namespace App\Source\RideRequest\Domain\RequestRide;

use App\Source\RideRequest\Infra\RequestRide\Services\SaveRideRequestService;
use App\Source\RideRequest\Infra\RequestRide\Specifications\IsRideRequestedSpecification;
use Exception;

class RequestRideBusinessLogic
{
    public function __construct(
        private IsRideRequestedSpecification $isRideRequestedSpecification,
        private SaveRideRequestService $saveRideRequestService
    ) {
    }

    public function requestRide(
        int $passengerId,
        int $rideId
    ): void {
        if ($this->isRideRequestedSpecification->isSatisfied($passengerId, $rideId)) {
            throw new Exception(__('Ride is requested'));
        }

        $this->saveRideRequestService->save($passengerId, $rideId);
        //TODO send email
    }
}
