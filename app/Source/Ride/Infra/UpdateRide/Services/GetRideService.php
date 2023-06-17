<?php

declare(strict_types=1);

namespace App\Source\Ride\Infra\UpdateRide\Services;

use App\Models\Ride;

class GetRideService
{
    public function getById(int $rideId): Ride
    {
        return Ride::query()
            ->where('id', $rideId)
            ->with([
                'fromPlace',
                'toPlace',
                'driver.driverProfile',
                'transitPlaces',
                'acceptedRideRequests'
            ])
            ->firstOrFail();
    }
}
