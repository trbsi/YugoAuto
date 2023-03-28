<?php

namespace App\Source\RideRequest\Infra\CancelRide\Services;

use App\Models\RideRequest;
use App\Source\RideRequest\Enum\RideRequestEnum;
use Illuminate\Support\Carbon;

class CancelRideService
{
    public function cancel(
        int $passengerId,
        int $rideId,
        int $authUserId
    ): RideRequest {
        $model = RideRequest::where('passenger_id', $passengerId)
            ->where('ride_id', $rideId)
            ->first();

        $model
            ->setStatus(RideRequestEnum::CANCELLED->value)
            ->setCancelledBy($authUserId)
            ->setCancelledTime(Carbon::now())
            ->save();

        return $model;
    }
}
