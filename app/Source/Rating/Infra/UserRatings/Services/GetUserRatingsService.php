<?php

declare(strict_types=1);

namespace App\Source\Rating\Infra\UserRatings\Services;

use App\Models\Rating;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetUserRatingsService
{
    public function getByUser(int $userId): LengthAwarePaginator
    {
        return Rating::query()
            ->with(['driver', 'passenger'])
            ->where('driver_id', $userId)
            ->orWhere('passenger_id', $userId)
            ->orderBy('id', 'DESC')
            ->paginate();
    }
}
