<?php

namespace App\Source\RideRequest\Infra\Common\Specifications;

use App\Models\Ride;

class CanDriverAccessRideSpecification
{
    public function isSatisfied(int $userId, int $rideId): bool
    {
        return Ride::where('driver_id', $userId)
                ->where('id', $rideId)
                ->count() > 0;
    }
}
