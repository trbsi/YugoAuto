<?php

namespace App\Source\RideRequest\Infra\Common\Services;

use App\Models\Ride;

class UpdatePendingRequestsCountService
{
    public function increaseForDriver(
        Ride $ride
    ): void {
        $driverProfile = $ride->driver->profile;
        $driverProfile->increasePendingRequestsCount()
            ->save();
    }

    public function decreaseForDriver(
        Ride $ride
    ): void {
        $driverProfile = $ride->driver->profile;
        $driverProfile->decreasePendingRequestsCount()
            ->save();
    }

    public function setToZeroForDriver(
        Ride $ride
    ): void {
        $driverProfile = $ride->driver->profile;
        $driverProfile->setPendingRequestsCount(0)
            ->save();
    }
}
