<?php

namespace App\Source\Public\Domain\Contact;

use App\Models\User;
use App\Source\SystemCommunication\Base\Infra\Events\SystemCommunicationEvent;
use App\Source\SystemCommunication\Email\Infra\Value\EmailSystemCommunicationValue;
use App\Source\SystemCommunication\Email\Infra\Value\FromValue;
use App\Source\SystemCommunication\Email\Infra\Value\ViewDataValue;

class ContactLogic
{
    public function sendForAuthUser(int $userId, string $message): void
    {
        $user = User::find($userId);
        $this->send($user->getEmail(), $user->getName(), $message);
    }

    public function sendForGuest(string $name, string $email, string $message): void
    {
        $this->send($email, $name, $message);
    }

    private function send(
        string $email,
        string $name,
        string $message
    ): void {
        $value = new EmailSystemCommunicationValue(
            [config('mail.admin_email')],
            __('Contact from site') . ' ' . config('app.name'),
            new ViewDataValue(body: $message),
            new FromValue($email, $name)
        );
        SystemCommunicationEvent::dispatch($value);
    }
}
