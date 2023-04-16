<?php

declare(strict_types=1);

namespace App\Source\Report\Domain\ReportUser;

use App\Models\User;
use App\Source\SystemCommunication\Base\Infra\Events\SystemCommunicationEvent;
use App\Source\SystemCommunication\Email\Infra\Value\EmailSystemCommunicationValue;
use App\Source\SystemCommunication\Email\Infra\Value\FromValue;
use App\Source\SystemCommunication\Email\Infra\Value\ViewDataValue;

class ReportUserLogic
{
    public function report(
        int $authUserId,
        int $reportedUserId,
        string $content
    ): void {
        $user = User::findOrFail($authUserId);
        $content = sprintf(
            '%s. <br><br> Reported user id: %s',
            $content,
            $reportedUserId
        );

        $event = new EmailSystemCommunicationValue(
            toEmails: ['admin'],
            subject: __('User report'),
            viewData: new ViewDataValue(body: $content),
            from: new FromValue(email: $user->getEmail(), name: $user->getName())
        );

        SystemCommunicationEvent::dispatch($event);
    }
}
