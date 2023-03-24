<?php

declare(strict_types=1);

namespace App\Source\SystemCommunication\Email\Infra\Value;

class FromValueObject
{
    private string $email;
    private string $name;

    public function __construct(
        string $email,
        string $name
    ) {
        $this->email = $email;
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
