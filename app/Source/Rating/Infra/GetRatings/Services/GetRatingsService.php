<?php

declare(strict_types=1);

namespace App\Source\Rating\Infra\GetRatings\Services;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Collection;

class GetRatingsService
{
    public function get(int $rideId): Collection
    {
        return Rating::where('ride_id', $rideId)
            ->with(['driver', 'passenger'])
            ->get();
    }
}
