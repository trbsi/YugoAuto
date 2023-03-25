<?php

declare(strict_types=1);

namespace App\Source\Ride\Infra\SearchRides\Services;

use App\Models\Ride;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class SearchRidesService
{
    public function search(
        int $fromPlaceId,
        int $toPlaceId,
        Carbon $minStartTime
    ): LengthAwarePaginator {
        $now = Carbon::now();

        $rides = Ride::where('from_place_id', $fromPlaceId)
            ->where('to_place_id', $toPlaceId)
            ->where('time', '>=', $minStartTime->format('Y-m-d H:i:s'))
            ->where('time', '>=', $now->format('Y-m-d H:i:s')) //has to be newer than current time
            ->with([
                'fromPlace',
                'toPlace',
                'driver',
                'rideRequestsForAuthUser',
            ])
            ->orderBy('time', 'ASC')
            ->paginate();

        return $rides;
    }
}
