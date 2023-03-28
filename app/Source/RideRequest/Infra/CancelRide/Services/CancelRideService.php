<?php

namespace App\Source\RideRequest\Infra\CancelRide\Services;

use App\Models\RideRequest;
use App\Source\RideRequest\Enum\RideRequestEnum;

class CancelRideService
{
    public function cancel(
        int $passengerId,
        int $rideId
    ): RideRequest {
        $model = RideRequest::where('passenger_id', $passengerId)
            ->where('ride_id', $rideId)
            ->first();

        $model
            ->setStatus(RideRequestEnum::CANCELLED->value)
            ->save();

        return $model;
    }
}
