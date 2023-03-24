<?php

namespace App\Source\RideRequest\Infra\RequestRide\Services;

use App\Models\RideRequest;
use App\Source\RideRequest\Enum\RideRequestEnum;

class SaveRideRequestService
{
    public function save(
        int $userId,
        int $rideId
    ): void {
        $model = new RideRequest();
        $model
            ->setRideId($rideId)
            ->setUserId($userId)
            ->setStatus(RideRequestEnum::PENDING->value)
            ->save();
    }
}
