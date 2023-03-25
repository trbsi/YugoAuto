<?php

namespace App\Source\RideRequest\Infra\CancelRide\Specifications;

use App\Models\Ride;
use App\Models\RideRequest;
use App\Source\RideRequest\Enum\RideRequestEnum;

class CanCancelRideSpecification
{
    public function satisfiedBy(int $authUserId, int $passengerId, int $rideId): bool
    {
        $rideRequestCount = RideRequest::where('passenger_id', $passengerId)
            ->where('ride_id', $rideId)
            ->whereIn('status', [RideRequestEnum::ACCEPTED->value])
            ->count();

        $ride = Ride::where('driver_id', $authUserId)
            ->where('id', $rideId)
            ->count();

        return $rideRequestCount || $ride;
    }
}
