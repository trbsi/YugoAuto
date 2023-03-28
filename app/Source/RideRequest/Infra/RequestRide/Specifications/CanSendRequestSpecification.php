<?php

declare(strict_types=1);

namespace App\Source\RideRequest\Infra\RequestRide\Specifications;

use App\Models\Ride;

class CanSendRequestSpecification
{
    public function isSatisfied(int $passengerId, int $rideId): bool
    {
        return Ride::where('id', $rideId)
                ->where('driver_id', $passengerId)
                ->count() === 0;
    }
}
