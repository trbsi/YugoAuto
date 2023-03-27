<?php

declare(strict_types=1);

namespace App\Source\Messaging\Infra\CreateConversation\Services;

use App\Models\UserProfile;

class UpdateUserProfileService
{
    public function updateUnreadMessagesCount(
        int $userId
    ): void {
        $model = UserProfile::where('user_id', $userId)->first();
        $model
            ->setUnreadMessagesCount($model->getUnreadMessagesCount() + 1)
            ->save();
    }
}
