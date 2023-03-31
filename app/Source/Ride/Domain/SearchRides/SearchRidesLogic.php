<?php

declare(strict_types=1);

namespace App\Source\Ride\Domain\SearchRides;

use App\Source\Ride\Infra\SearchRides\Services\SearchRidesService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class SearchRidesLogic
{
    private SearchRidesService $searchRidesService;

    public function __construct(
        SearchRidesService $searchRidesService
    ) {
        $this->searchRidesService = $searchRidesService;
    }

    public function search(
        int $fromPlaceId,
        int $toPlaceId,
        ?Carbon $minStartTime,
        ?Carbon $maxStartTime,
        string $filter
    ): LengthAwarePaginator {
        $now = Carbon::now();
        if ($minStartTime < $now) {
            $minStartTime = $now;
        }

        return $this->searchRidesService->search(
            fromPlaceId: $fromPlaceId,
            toPlaceId: $toPlaceId,
            minStartTime: $minStartTime,
            maxStartTime: $maxStartTime,
            filter: $filter
        );
    }

    public function latestRides(): Collection
    {
        return $this->searchRidesService->latestRides();
    }
}
