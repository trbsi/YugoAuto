<?php

declare(strict_types=1);

namespace App\Source\SystemCommunication\Email\Infra\Services;

use App\Source\SystemCommunication\Base\Infra\Services\SendSystemCommunicationInterface;
use App\Source\SystemCommunication\Base\Infra\Value\SystemCommunicationValueInterface;
use App\Source\SystemCommunication\Email\Infra\Mailable\MarkdownEmailMailable;
use App\Source\SystemCommunication\Email\Infra\Value\EmailSystemCommunicationValue;
use Exception;
use Illuminate\Support\Facades\Log;
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

        try {
            Mail::to($emails)->send($mail);
        } catch (Exception $exception) {
            Log::notice('Email sent failed', [
                'exception' => $exception->getMessage(),
                'code' => $exception->getCode(),
                'exceptionClass' => get_class($exception)
            ]);
        }
    }
}
