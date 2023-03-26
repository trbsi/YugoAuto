<?php

namespace App\Source\Ride\Infra\CreateRide\Specifications;

use App\Models\Ride;
use Illuminate\Support\Carbon;

class CanCreateRideSpecification
{
    public function isSatisfied(int $driverId): bool
    {
        $now = Carbon::now();
        
        return Ride::where('driver_id', $driverId)
                ->whereRaw(sprintf('DATE(time) = %s', $now->format('Y-m-d')))
                ->count() === 0;
    }
}
