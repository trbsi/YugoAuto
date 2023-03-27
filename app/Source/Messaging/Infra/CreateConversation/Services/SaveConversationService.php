<?php

declare(strict_types=1);

namespace App\Source\Messaging\Infra\CreateConversation\Services;

use App\Models\Conversation;

class SaveConversationService
{
    public function save(
        int $senderId,
        int $recipientId
    ): Conversation {
        $model = new Conversation();
        $model
            ->setSenderId($senderId)
            ->setSenderRead(true)
            ->setRecipientId($recipientId)
            ->setRecipientRead(false)
            ->save();

        return $model;
    }
}
