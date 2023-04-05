<?php

declare(strict_types=1);

namespace App\Source\SystemCommunication\Email\Infra\Value;

class ViewDataValue
{
    public function __construct(
        private readonly string $body,
        private readonly null|string $buttonUrl = null,
        private readonly null|string $buttonText = null
    ) {
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getButtonUrl(): ?string
    {
        return $this->buttonUrl;
    }

    public function getButtonText(): ?string
    {
        return $this->buttonText;
    }

    public function toArray(): array
    {
        return [
            'body' => $this->body,
            'buttonUrl' => $this->buttonUrl,
            'buttonText' => $this->buttonText,
        ];
    }
}
