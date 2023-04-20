<?php

namespace App\Source\RideRequest\Infra\Common\Services;

use App\Models\Ride;

class UpdatePendingRequestsCountService
{
    public function increase(
        Ride $ride
    ): void {
        $driverProfile = $ride->driver->profile;
        $driverProfile->increasePendingRequestsCount()
            ->save();
    }

    public function decrease(
        Ride $ride
    ): void {
        $driverProfile = $ride->driver->profile;
        $driverProfile->decreasePendingRequestsCount()
            ->save();
    }

    public function setToZero(
        Ride $ride
    ): void {
        $driverProfile = $ride->driver->profile;
        $driverProfile->setPendingRequestsCount(0)
            ->save();
    }
}
