<?php

declare(strict_types=1);

namespace App\Source\SystemCommunication\Email\Infra\Value;

use App\Source\SystemCommunication\Base\Infra\Value\SystemCommunicationValueInterface;

final class EmailSystemCommunicationValue implements SystemCommunicationValueInterface
{
    private array $toEmails;
    private ?FromValue $from;
    private string $subject;
    private string $bladeView;
    private ViewDataValue $viewData;

    public function __construct(
        array $toEmails,
        string $subject,
        ViewDataValue $viewData,
        ?FromValue $from = null,
        string $bladeView = 'emails.default_mail'
    ) {
        $this->toEmails = $toEmails;
        $this->from = $from;
        $this->subject = $subject;
        $this->bladeView = $bladeView;
        $this->viewData = $viewData;
    }

    public function getToEmails(): array
    {
        return array_filter($this->toEmails);
    }

    public function getFrom(): ?FromValue
    {
        return $this->from;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getBladeView(): string
    {
        return $this->bladeView;
    }

    public function getViewData(): ViewDataValue
    {
        return $this->viewData;
    }
}
