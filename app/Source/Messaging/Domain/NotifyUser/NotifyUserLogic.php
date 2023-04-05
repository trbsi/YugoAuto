<?php

declare(strict_types=1);

namespace App\Source\Messaging\Domain\NotifyUser;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use App\Source\SystemCommunication\Base\Infra\Events\SystemCommunicationEvent;
use App\Source\SystemCommunication\Email\Infra\Value\EmailSystemCommunicationValue;
use App\Source\SystemCommunication\Email\Infra\Value\ViewDataValue;
use App\Source\SystemCommunication\PushNotification\Infra\Value\PushNotificationConversationValue;

class NotifyUserLogic
{
    public static function notifyRecipient(
        Conversation $conversation,
        Message $lastMessage,
        User $sender,
        User $recipient
    ): void {
        self::sendEmail(
            conversation: $conversation,
            sender: $sender,
            recipient: $recipient
        );
        self::sendPush(
            conversation: $conversation,
            lastMessage: $lastMessage,
            sender: $sender
        );
    }

    private static function sendEmail(
        Conversation $conversation,
        User $sender,
        User $recipient
    ): void {
        $subject = sprintf('%s - %s', __('You have a new message'), config('app.name'));
        $body = __('Somebody sent you a message', ['name' => $sender->getName()]);

        $viewData = new ViewDataValue(
            body: $body,
            buttonUrl: conversation_url($conversation->getId()),
            buttonText: __('View messages')
        );
        $event = new EmailSystemCommunicationValue(
            toEmails: [$recipient->getEmail()],
            subject: $subject,
            viewData: $viewData
        );
        SystemCommunicationEvent::dispatch($event);
    }

    private static function sendPush(
        Conversation $conversation,
        Message $lastMessage,
        User $sender
    ): void {
        $event = new PushNotificationConversationValue(
            title: $sender->getName(),
            body: substr($lastMessage->getContent(), 0, 200),
            conversationId: $conversation->getId(),
            senderId: $sender->getId(),
            additionalData: [
                'conversationId' => $conversation->getId()
            ]
        );


        SystemCommunicationEvent::dispatch($event);
    }
}
