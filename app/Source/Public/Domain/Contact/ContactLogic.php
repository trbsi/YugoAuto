<?php

namespace App\Source\Public\Domain\Contact;

use App\Models\User;
use App\Source\SystemCommunication\Base\Infra\Events\SystemCommunicationEvent;
use App\Source\SystemCommunication\Email\Infra\Value\EmailSystemCommunicationValue;
use App\Source\SystemCommunication\Email\Infra\Value\FromValue;
use App\Source\SystemCommunication\Email\Infra\Value\ViewDataValue;
use Illuminate\Support\Carbon;

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
        $subject = sprintf(
            '%s %s %s',
            __('Contact from site'),
            config('app.name'),
            Carbon::now()->format('Y-m-d H:i:s')
        );
        $value = new EmailSystemCommunicationValue(
            [config('mail.admin_email')],
            $subject,
            new ViewDataValue(body: $message),
            new FromValue($email, $name)
        );
        SystemCommunicationEvent::dispatch($value);
    }
}
