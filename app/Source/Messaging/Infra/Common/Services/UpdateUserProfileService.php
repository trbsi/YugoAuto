<?php

declare(strict_types=1);

namespace App\Source\Messaging\Infra\Common\Services;

use App\Models\Conversation;
use App\Models\UserProfile;

class UpdateUserProfileService
{
    public function increaseUnreadMessagesCount(
        int $userId
    ): void {
        $model = UserProfile::where('user_id', $userId)->first();
        $model
            ->setUnreadMessagesCount(1)
            ->save();
    }

    public function decreaseUnreadMessagesCount(
        Conversation $conversation,
        int $userId
    ): void {
        //if user already read the message, don't decrease unread messages count
        if ($conversation->isReadByUser()) {
            return;
        }

        $model = UserProfile::where('user_id', $userId)->first();
        $model
            ->setUnreadMessagesCount(0)
            ->save();
    }
}
