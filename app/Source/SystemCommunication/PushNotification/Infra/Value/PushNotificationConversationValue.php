<?php

declare(strict_types=1);

namespace App\Source\SystemCommunication\PushNotification\Infra\Value;

class PushNotificationConversationValue extends PushNotificationGenericValue
{
    private const NOTIFICATION_TYPE_CONVERSATION = 'conversation';

    private int $conversationId;
    private int $senderId;

    public function __construct(
        string $title,
        string $body,
        int $conversationId,
        int $senderId,
        array $additionalData = []
    ) {
        $this->conversationId = $conversationId;
        $this->senderId = $senderId;

        parent::__construct(
            $title,
            $body,
            0,
            $additionalData,
            self::OPEN_SCREEN_CONVERSATIONS
        );
    }

    public function getConversationId(): int
    {
        return $this->conversationId;
    }

    public function getSenderId(): int
    {
        return $this->senderId;
    }

    public function getNotificationType(): string
    {
        return self::NOTIFICATION_TYPE_CONVERSATION;
    }
}
