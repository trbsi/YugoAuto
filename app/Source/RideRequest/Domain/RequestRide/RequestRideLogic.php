<?php

namespace App\Source\RideRequest\Domain\RequestRide;

use App\Models\Ride;
use App\Source\RideRequest\Domain\SendEmail\SendEmailLogic;
use App\Source\RideRequest\Infra\RequestRide\Services\SaveRideRequestService;
use App\Source\RideRequest\Infra\RequestRide\Specifications\IsRideRequestedSpecification;
use Exception;

class RequestRideLogic
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
            throw new Exception(__('Ride is already requested'));
        }

        $ride = Ride::firstOrFail($rideId);
        $rideRequest = $this->saveRideRequestService->save($passengerId, $rideId);
        SendEmailLogic::sendEmailToDriver($ride, $rideRequest);
    }
}
