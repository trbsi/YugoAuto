<?php

declare(strict_types=1);

namespace App\Source\Rating\Infra\SaveRating\Services;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Builder;

class SaveRatingService
{
    public function save(
        int $graderId,
        int $userToBeRatedId,
        int $rideId,
        int $rating,
        ?string $comment
    ): Rating {
        $model = Rating::where(function (Builder $query) use ($graderId, $userToBeRatedId) {
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
            ->firstOrFail();

        if ($model->getDriverId() === $graderId) {
            $comment = trim(sprintf('%s %s', $model->getPassengerComment(), $comment));
            $model
                ->setPassengerComment($comment)
                ->setPassengerRating($rating);
        } else {
            $comment = trim(sprintf('%s %s', $model->getDriverComment(), $comment));
            $model
                ->setDriverComment($comment)
                ->setDriverRating($rating);
        }

        $model->save();
        return $model;
    }
}
