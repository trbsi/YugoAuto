<?php

namespace App\Source\Public\Domain\Contact;

use App\Models\User;
use App\Source\SystemCommunication\Base\Infra\Events\SystemCommunicationEvent;
use App\Source\SystemCommunication\Email\Infra\Value\EmailSystemCommunicationValue;
use App\Source\SystemCommunication\Email\Infra\Value\FromValueObject;

class ContactBusinessLogic
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
            [$email],
            'Contact from site ' . config('app.name'),
            ['body' => $message],
            new  FromValueObject($email, $name)
        );
        SystemCommunicationEvent::dispatch($value);
    }
}
