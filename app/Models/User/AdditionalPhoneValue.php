<?php

namespace App\Models\User;

class AdditionalPhoneValue
{
    public function __construct(
        private string $phoneNumber,
        private bool $isVerified
    ) {
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function toArray(): array
    {
        return [
            'phoneNumber' => $this->getPhoneNumber(),
            'isVerified' => $this->isVerified(),
        ];
    }
}
