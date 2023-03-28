<?php

declare(strict_types=1);

namespace App\Source\Rating\Infra\SaveRating\Services;

use App\Models\UserProfile;

class UpdateProfileRatingService
{
    public function update(int $userId, int $rating): void
    {
        $profile = UserProfile::where('user_id', $userId)->first();
        $profile
            ->setRatingCount($profile->getRatingCount() + 1)
            ->setRatingSum($profile->getRatingSum() + $rating)
            ->save();
    }
}
