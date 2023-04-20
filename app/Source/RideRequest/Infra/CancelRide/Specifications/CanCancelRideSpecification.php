<?php

namespace App\Source\RideRequest\Infra\CancelRide\Specifications;

use App\Models\Ride;
use App\Models\RideRequest;

class CanCancelRideSpecification
{
    public function satisfiedBy(int $authUserId, RideRequest $rideRequest, Ride $ride): bool
    {
        if ($ride->isNonActiveRide()) {
            return false;
        }

        //user is passenger
        if ($rideRequest->getPassengerId() === $authUserId && $rideRequest->isAccepted()) {
            return true;
        }

        //user is driver
        if ($ride->getDriverId() === $authUserId) {
            return true;
        }

        return false;
    }
}
