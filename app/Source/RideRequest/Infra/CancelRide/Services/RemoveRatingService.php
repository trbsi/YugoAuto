<?php

declare(strict_types=1);

namespace App\Source\RideRequest\Infra\CancelRide\Services;

use App\Models\Rating;
use App\Models\Ride;

class RemoveRatingService
{
    public function remove(Ride $ride, int $passengerId): void
    {
        Rating::where('ride_id', $ride->getId())
            ->where('driver_id', $ride->getDriverId())
            ->where('passenger_id', $passengerId)
            ->delete();
    }
}
