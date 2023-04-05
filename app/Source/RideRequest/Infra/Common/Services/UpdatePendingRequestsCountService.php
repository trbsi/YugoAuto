<?php

namespace App\Source\RideRequest\Infra\Common\Services;

use App\Models\Ride;

class UpdatePendingRequestsCountService
{
    public function increase(
        Ride $ride
    ): void {
        $driverProfile = $ride->driver->profile;
        $driverProfile->setPendingRequestsCount($driverProfile->getPendingRequestsCount() + 1)
            ->save();
    }

    public function decrease(
        Ride $ride
    ): void {
        $driverProfile = $ride->driver->profile;

        //do not go below 0
        if ($driverProfile->getPendingRequestsCount() === 0) {
            return;
        }
        
        $driverProfile->setPendingRequestsCount($driverProfile->getPendingRequestsCount() - 1)
            ->save();
    }
}
