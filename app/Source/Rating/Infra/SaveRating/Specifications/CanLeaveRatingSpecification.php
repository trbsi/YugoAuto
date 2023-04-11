<?php

declare(strict_types=1);

namespace App\Source\Rating\Infra\SaveRating\Specifications;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Builder;

class CanLeaveRatingSpecification
{
    public function satisfiedBy(
        int $graderId,
        int $userToBeRatedId,
        int $rideId,
    ): bool {
        return Rating::where(function (Builder $query) use ($graderId, $userToBeRatedId) {
                $query->where(
                    function (Builder $query) use ($graderId, $userToBeRatedId) {
                        $query
                            ->where('driver_id', $graderId)
                            ->where('passenger_id', $userToBeRatedId);
                    }
                )->orWhere(
                    function (Builder $query) use ($graderId, $userToBeRatedId) {
                        $query
                            ->where('driver_id', $userToBeRatedId)
                            ->where('passenger_id', $graderId);
                    }
                );
            })
                ->where('ride_id', $rideId)
                ->count() > 0;
    }
}
