<?php

namespace App\Source\RideRequest\Infra\RequestRide\Specifications;

use App\Models\RideRequest;

class IsRideRequestedSpecification
{
    public function isSatisfied(
        int $passengerId,
        int $rideId
    ): bool {
        $count = RideRequest::where('passenger_id', $passengerId)
            ->where('ride_id', $rideId)
            ->count();

        return $count > 0;
    }
}
