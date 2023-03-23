<?php

declare(strict_types=1);

namespace App\Source\Ride\Infra\MyRides\Services;

use App\Models\Ride;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetRidesByUserService
{
    public function get(int $userId): LengthAwarePaginator
    {
        return Ride::where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->paginate();
    }
}