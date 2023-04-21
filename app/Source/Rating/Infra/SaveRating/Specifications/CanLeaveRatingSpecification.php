<?php

declare(strict_types=1);

namespace App\Source\Rating\Infra\SaveRating\Specifications;

use App\Models\Rating;

class CanLeaveRatingSpecification
{
    public function satisfiedBy(
        int $graderId,
        int $userToBeRatedId,
        int $ratingId,
    ): bool {
        $rating = Rating::findOrFail($ratingId);

        if ($rating->getDriverId() === $graderId && $rating->getPassengerId() === $userToBeRatedId) {
            return true;
        }

        if ($rating->getDriverId() === $userToBeRatedId && $rating->getPassengerId() === $graderId) {
            return true;
        }

        return false;
    }
}
