<?php

declare(strict_types=1);

namespace App\Source\Rating\Infra\SaveRating\Services;

use App\Models\Rating;

class SaveRatingService
{
    public function save(
        int $graderId,
        int $ratingId,
        int $rating,
        ?string $comment
    ): Rating {
        $model = Rating::find($ratingId);

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
