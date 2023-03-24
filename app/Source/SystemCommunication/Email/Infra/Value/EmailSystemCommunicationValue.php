<?php

declare(strict_types=1);

namespace App\Source\SystemCommunication\Email\Infra\Value;

use App\Source\SystemCommunication\Base\Infra\Value\SystemCommunicationValueInterface;

final class EmailSystemCommunicationValue implements SystemCommunicationValueInterface
{
    private array $toEmails;
    private ?FromValueObject $from;
    private string $subject;
    private string $bladeView;
    private array $viewData;

    public function __construct(
        array $toEmails,
        string $subject,
        array $viewData = [],
        ?FromValueObject $from = null,
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

    public function getFrom(): ?FromValueObject
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

    public function getViewData(): array
    {
        return $this->viewData;
    }
}
