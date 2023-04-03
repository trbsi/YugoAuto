<?php

declare(strict_types=1);

namespace App\Source\SystemCommunication\PushNotification\Infra\Services;

use App\Models\Conversation;
use App\Models\PushToken;
use Illuminate\Database\Eloquent\Collection;

class GetPushTokensService
{
    public function getPushTokensFromConversation(int $conversationId, int $senderId, string $tokenType): Collection
    {
        $conversation = Conversation::findOrFail($conversationId);

        return PushToken::where('user_id', $conversation->getOtherUser($senderId)->getId())
            ->where('token_type', $tokenType)
            ->get();
    }

    public function getPushTokensByUser(int $userId, string $tokenType): Collection
    {
        return PushToken::where('user_id', $userId)
            ->where('token_type', $tokenType)
            ->get();
    }
}
