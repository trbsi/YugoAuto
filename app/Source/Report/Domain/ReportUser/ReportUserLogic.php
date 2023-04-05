<?php

declare(strict_types=1);

namespace App\Source\Report\Domain\ReportUser;

use App\Models\User;
use App\Source\SystemCommunication\Base\Infra\Events\SystemCommunicationEvent;
use App\Source\SystemCommunication\Email\Infra\Value\EmailSystemCommunicationValue;
use App\Source\SystemCommunication\Email\Infra\Value\FromValueObject;

class ReportUserLogic
{
    public function report(
        int $userId,
        string $content
    ): void {
        $user = User::findOrFail($userId);
        $event = new EmailSystemCommunicationValue(
            toEmails: ['admin'],
            subject: __('User report'),
            viewData: [
                'body' => $content
            ],
            from: new FromValueObject(email: $user->getEmail(), name: $user->getName())
        );

        SystemCommunicationEvent::dispatch($event);
    }
}
