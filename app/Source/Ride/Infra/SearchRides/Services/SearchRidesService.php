<?php

declare(strict_types=1);

namespace App\Source\Ride\Infra\SearchRides\Services;

use App\Models\Ride;
use App\Source\Ride\Enum\RideFiltersEnum;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class SearchRidesService
{
    public function search(
        int $fromPlaceId,
        int $toPlaceId,
        Carbon $minStartTime,
        string $filter
    ): LengthAwarePaginator {
        //TODO - check query index
        $rides = Ride::where('from_place_id', $fromPlaceId)
            ->where('to_place_id', $toPlaceId)
            ->where('time', '>=', $minStartTime->format('Y-m-d H:i:s'))
            ->with([
                'fromPlace',
                'toPlace',
                'driver',
                'rideRequestForAuthUser',
                'acceptedRideRequests'
            ]);

        $rides = match ($filter) {
            RideFiltersEnum::PRICE_LOWEST->value => $rides->orderBy('price', 'ASC'),
            RideFiltersEnum::PRICE_HIGHEST->value => $rides->orderBy('price', 'DESC'),
            RideFiltersEnum::TIME_EARLIEST->value => $rides->orderBy('time', 'ASC'),
            RideFiltersEnum::TIME_LATEST->value => $rides->orderBy('time', 'DESC'),
            default => $rides->orderBy('time', 'DESC')
        };

        return $rides->paginate();
    }

    public function latestRides(): Collection
    {
        return Ride::orderBy('id', 'DESC')
            ->where('time', '>=', Carbon::now()->format('Y-m-d H:i:s'))
            ->limit(20)
            ->get();
    }
}
