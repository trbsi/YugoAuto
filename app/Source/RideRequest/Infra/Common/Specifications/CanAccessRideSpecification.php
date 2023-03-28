<?php

namespace App\Source\RideRequest\Infra\Common\Specifications;

use App\Models\Ride;
use App\Models\RideRequest;
use App\Source\RideRequest\Enum\RideRequestEnum;

class CanAccessRideSpecification
{
    public function isSatisfiedByDriver(int $userId, int $rideId): bool
    {
        return Ride::where('driver_id', $userId)
                ->where('id', $rideId)
                ->count() > 0;
    }

    public function isSatisfiedByDriverOrPassenger(
        int $userId,
        int $rideId,
        null|RideRequestEnum $status
    ): bool {
        $rideCount = Ride::where('driver_id', $userId)
                ->where('id', $rideId)
                ->count() > 0;

        $rideRequestCount = RideRequest::where('passenger_id', $userId)
            ->where('ride_id', $rideId);

        if ($status !== null) {
            $rideRequestCount->where('status', $status->value);
        }
        $rideRequestCount = $rideRequestCount->count();

        return $rideCount || $rideRequestCount;
    }
}
