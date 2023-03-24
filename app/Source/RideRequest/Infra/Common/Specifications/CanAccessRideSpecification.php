<?php

namespace App\Source\RideRequest\Infra\Common\Specifications;

use App\Models\Ride;

class CanAccessRideSpecification
{
    public function isSatisfied(int $userId, int $rideId): bool
    {
        return Ride::where('user_id', $userId)
                ->where('id', $rideId)
                ->count() > 0;
    }
}
