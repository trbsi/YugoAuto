<?php

namespace App\Source\RideRequest\Infra\RideRequests\Services;

use App\Models\RideRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetRideRequestsService
{
    public function get(int $rideId): LengthAwarePaginator
    {
        return RideRequest::where('ride_id', $rideId)
            ->orderBy('id', 'DESC')
            ->with(['user.profile'])
            ->paginate();
    }
}
