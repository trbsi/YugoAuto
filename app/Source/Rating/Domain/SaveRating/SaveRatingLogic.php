<?php

declare(strict_types=1);

namespace App\Source\Rating\Domain\SaveRating;

use App\Source\Rating\Infra\SaveRating\Services\SaveRatingService;
use App\Source\Rating\Infra\SaveRating\Services\UpdateProfileRatingService;
use App\Source\Rating\Infra\SaveRating\Specifications\CanLeaveRatingSpecification;
use Exception;

class SaveRatingLogic
{
    public function __construct(
        private readonly CanLeaveRatingSpecification $canLeaveRatingSpecification,
        private readonly SaveRatingService $saveRatingService,
        private readonly UpdateProfileRatingService $updateProfileRatingService
    ) {
    }

    public function save(
        int $graderId,
        int $userToBeRatedId,
        int $rideId,
        int $rating,
        ?string $comment
    ): void {
        $isSatisfied = $this->canLeaveRatingSpecification->satisfiedBy(
            graderId: $graderId,
            userToBeRatedId: $userToBeRatedId,
            rideId: $rideId
        );
        if (!$isSatisfied) {
            throw new Exception(__('You cannot access this page'));
        }

        $model = $this->saveRatingService->save(
            graderId: $graderId,
            userToBeRatedId: $userToBeRatedId,
            rideId: $rideId,
            rating: $rating,
            comment: $comment
        );

        $this->updateProfileRatingService->update($model->getRatedUser()->getId(), $rating);
    }
}
