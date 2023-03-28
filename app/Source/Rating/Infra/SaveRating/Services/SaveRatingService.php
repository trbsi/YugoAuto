<?php

declare(strict_types=1);

namespace App\Source\Rating\Infra\SaveRating\Services;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Builder;

class SaveRatingService
{
    public function save(
        int $graderId,
        int $rideId,
        int $rating,
        ?string $comment
    ): void {
        $model = Rating::where(function (Builder $query) use ($graderId) {
            $query->where('driver_id', $graderId)
                ->orWhere('passenger_id', $graderId);
        })
            ->where('ride_id', $rideId)
            ->firstOrFail();

        if ($model->getDriverId() === $graderId) {
            $model
                ->setPassengerComment($comment)
                ->setPassengerRating($rating);
        } else {
            $model
                ->setDriverComment($comment)
                ->setDriverRating($rating);
        }

        $model->save();
    }
}
