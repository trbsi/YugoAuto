<?php

declare(strict_types=1);

namespace App\Source\Messaging\Domain\SendEmail;

use App\Models\Conversation;
use App\Models\User;
use App\Source\SystemCommunication\Base\Infra\Events\SystemCommunicationEvent;
use App\Source\SystemCommunication\Email\Infra\Value\EmailSystemCommunicationValue;

class SendEmailLogic
{
    public static function sendEmailToRecipient(
        Conversation $conversation,
        User $sender,
        User $recipient
    ): void {
        $subject = sprintf('%s - %s', __('You have a new message'), config('app.name'));
        $body = __('Somebody sent you a message', ['name' => $sender->getName()]);

        $viewData = [
            'body' => $body,
            'buttonUrl' => conversation_url($conversation->getId()),
            'buttonText' => __('View messages')
        ];
        $event = new EmailSystemCommunicationValue(
            toEmails: [$recipient->getEmail()],
            subject: $subject,
            viewData: $viewData
        );
        SystemCommunicationEvent::dispatch($event);
    }
}
