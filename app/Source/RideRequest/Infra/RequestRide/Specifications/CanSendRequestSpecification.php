<?php

declare(strict_types=1);

namespace App\Source\RideRequest\Infra\RequestRide\Specifications;

use App\Models\Ride;
use App\Models\RideRequest;
use App\Source\RideRequest\Enum\RideRequestEnum;
use Illuminate\Support\Carbon;

class CanSendRequestSpecification
{
    public function isSatisfiedByDriver(int $passengerId, Ride $ride): bool
    {
        //cannot send request to your self
        if ($passengerId === $ride->getDriverId()) {
            return false;
        }

        return true;
    }

    public function isSatisfiedByTimeAndRoute(
        int $passengerId,
        Ride $ride
    ): bool {
        $now = Carbon::now();

        //user cannot request ride for the same route in the same day
        $rideIds = RideRequest::where('passenger_id', $passengerId)
            ->whereRaw(sprintf('DATE(created_at) = "%s"', $now->format('Y-m-d')))
            ->whereIn('status', [RideRequestEnum::PENDING->value, RideRequestEnum::ACCEPTED->value])
            ->get()
            ->pluck('ride_id')
            ->toArray();

        return Ride::whereIn('id', $rideIds)
                ->where('from_place_id', $ride->getFromPlaceId())
                ->where('to_place_id', $ride->getToPlaceId())
                ->whereRaw(sprintf('DATE(time_utc) = "%s"', Carbon::now()->format('Y-m-d')))
                ->count() === 0;
    }
}
