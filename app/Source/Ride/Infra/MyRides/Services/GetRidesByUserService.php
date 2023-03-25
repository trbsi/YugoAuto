<?php

declare(strict_types=1);

namespace App\Source\Ride\Infra\MyRides\Services;

use App\Models\Ride;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class GetRidesByUserService
{
    public function get(int $userId): LengthAwarePaginator
    {
        return Ride::where('user_id', $userId)
            ->orderBy('time', 'desc')
            ->with(['user', 'pendingRideRequests', 'rideRequestsForAuthUser'])
            ->orWhereHas('rideRequests', function (Builder $query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->paginate();
    }
}
