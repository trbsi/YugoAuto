<?php

namespace App\Source\Ride\Infra\CreateRide\Specifications;

use App\Models\Ride;
use Illuminate\Support\Carbon;

class CanCreateRideSpecification
{
    public function isSatisfied
    (
        int $driverId,
        Carbon $creationTime,
        int $fromPlaceId,
        int $toPlaceId
    ): bool {
        //make sure user cannot create multiple rides for the same locations for that day
        return Ride::where('driver_id', $driverId)
                ->where('to_place_id', $toPlaceId)
                ->where('from_place_id', $fromPlaceId)
                ->whereRaw(sprintf('DATE(time) = "%s"', $creationTime->format('Y-m-d')))
                ->count() === 0;
    }
}
