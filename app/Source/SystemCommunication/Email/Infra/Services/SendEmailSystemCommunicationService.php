<?php

declare(strict_types=1);

namespace App\Source\SystemCommunication\Email\Infra\Services;

use App\Source\SystemCommunication\Base\Infra\Services\SendSystemCommunicationInterface;
use App\Source\SystemCommunication\Base\Infra\Value\SystemCommunicationValueInterface;
use App\Source\SystemCommunication\Email\Infra\Mailable\MarkdownEmailMailable;
use App\Source\SystemCommunication\Email\Infra\Value\EmailSystemCommunicationValue;
use Illuminate\Support\Facades\Mail;

class SendEmailSystemCommunicationService implements SendSystemCommunicationInterface
{
    private GetAdminEmailsService $getAdminEmailsService;

    public function __construct(
        GetAdminEmailsService $getAdminEmailsService
    ) {
        $this->getAdminEmailsService = $getAdminEmailsService;
    }

    /**
     * @param EmailSystemCommunicationValue $communicationValue
     */
    public function send(SystemCommunicationValueInterface $communicationValue): void
    {
        $mail = new MarkdownEmailMailable(
            $communicationValue->getSubject(),
            $communicationValue->getBladeView(),
            $communicationValue->getViewData(),
            $communicationValue->getFrom()
        );

        if (empty($communicationValue->getToEmails())) {
            return;
        }

        if ($communicationValue->getToEmails()[0] === 'admin') {
            $emails = $this->getAdminEmailsService->getAdminEmails();
        } else {
            $emails = $communicationValue->getToEmails();
        }

        Mail::to($emails)->send($mail);
    }
}
