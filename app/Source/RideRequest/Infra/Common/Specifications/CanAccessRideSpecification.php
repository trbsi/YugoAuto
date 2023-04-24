<?php

namespace App\Source\RideRequest\Infra\Common\Specifications;

use App\Models\Ride;
use App\Models\RideRequest;
use App\Source\RideRequest\Enum\RideRequestEnum;

class CanAccessRideSpecification
{
    public function isSatisfiedByDriver(int $driverId, int $rideId): bool
    {
        return Ride::where('id', $rideId)
                ->where('driver_id', $driverId)
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

        if ($rideCount) {
            return true;
        }

        $rideRequest = RideRequest::where('ride_id', $rideId)
            ->where('passenger_id', $userId)
            ->first();

        if ($rideRequest && ($rideRequest->isAccepted() || $rideRequest->isCancelledAtLastMinute())) {
            return true;
        }

        return false;
    }
}
