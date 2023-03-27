<?php

declare(strict_types=1);

namespace App\Source\Messaging\Infra\Common\Services;

use App\Models\Conversation;

class UpdateConversationService
{
    public function markConversationAsRead(Conversation $conversation, int $senderId): Conversation
    {
        //just so updated_at is not updated
        if ($conversation->isReadByUser()) {
            return $conversation;
        }

        if ($conversation->getSenderId() === $senderId) {
            $conversation->setSenderRead(true);
        } else {
            $conversation->setRecipientRead(true);
        }

        $conversation->save();
        return $conversation;
    }

    public function markConversationAsUnread(Conversation $conversation, int $senderId): Conversation
    {
        //just so updated_at is not updated
        //no need to set to false because it is already false
        if (false === $conversation->isReadByUser()) {
            return $conversation;
        }

        if ($conversation->getSenderId() === $senderId) {
            $conversation->setRecipientRead(false);
        } else {
            $conversation->setSenderRead(false);
        }

        $conversation->save();
        return $conversation;
    }
}
