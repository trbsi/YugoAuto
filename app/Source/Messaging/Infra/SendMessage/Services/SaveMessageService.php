<?php

declare(strict_types=1);

namespace App\Source\Messaging\Infra\SendMessage\Services;

use App\Models\Message;

class SaveMessageService
{
    public function save(
        int $senderId,
        int $conversationId,
        string $content
    ): void {
        $model = new Message();
        $model
            ->setSenderId($senderId)
            ->setConversationId($conversationId)
            ->setContent($content)
            ->save();
    }
}
