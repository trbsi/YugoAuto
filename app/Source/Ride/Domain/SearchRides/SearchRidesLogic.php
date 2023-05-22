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
        array $toPlaceIds,
        ?Carbon $minStartTime,
        ?Carbon $maxStartTime,
        bool $isAcceptingPackage,
        string $filter
    ): LengthAwarePaginator {
        $now = Carbon::now()->startOfDay();
        if ($minStartTime < $now) {
            $minStartTime = $now;
        }

        try {
            return $this->searchRidesService->search(
                fromPlaceId: $fromPlaceId,
                toPlaceIds: $toPlaceIds,
                minStartTime: $minStartTime,
                maxStartTime: $maxStartTime,
                isAcceptingPackage: $isAcceptingPackage,
                filter: $filter
            );
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function latestRides(): Collection
    {
        return $this->searchRidesService->latestRides();
    }
}
