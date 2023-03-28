<?php

declare(strict_types=1);

namespace App\Source\Rating\Infra\SaveRating\Specifications;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Builder;

class CanLeaveRatingSpecification
{
    public function satisfiedBy(int $userId, int $rideId): bool
    {
        return Rating::where(function (Builder $query) use ($userId) {
                $query->where('driver_id', $userId)
                    ->orWhere('passenger_id', $userId);
            })
                ->where('ride_id', $rideId)
                ->count() > 0;
    }
}
