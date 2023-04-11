<?php

declare(strict_types=1);

namespace App\Source\Rating\Domain\UserRatings;


use App\Source\Rating\Infra\UserRatings\Services\GetUserRatingsService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetUserRatingsLogic
{
    public function __construct(
        private readonly GetUserRatingsService $getUserRatingsService
    ) {
    }

    public function getRatings(int $userId): LengthAwarePaginator
    {
        return $this->getUserRatingsService->getByUser($userId);
    }
}
