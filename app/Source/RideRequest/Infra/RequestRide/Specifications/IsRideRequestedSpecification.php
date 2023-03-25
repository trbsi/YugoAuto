<?php

namespace App\Source\RideRequest\Infra\RequestRide\Specifications;

use App\Models\RideRequest;

class IsRideRequestedSpecification
{
    public function isSatisfied(
        int $passengerId,
        int $rideId
    ): bool {
        return RideRequest::where('passenger_id', $passengerId)
                ->where('ride_id', $rideId)
                ->count() > 0;
    }
}
