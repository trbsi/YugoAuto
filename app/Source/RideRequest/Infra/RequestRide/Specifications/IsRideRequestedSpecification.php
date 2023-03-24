<?php

namespace App\Source\RideRequest\Infra\RequestRide\Specifications;

use App\Models\RideRequest;

class IsRideRequestedSpecification
{
    public function isSatisfied(
        int $userId,
        int $rideId
    ): bool {
        $count = RideRequest::where('user_id', $userId)
            ->where('ride_id', $rideId)
            ->count();

        return $count > 0;
    }
}
