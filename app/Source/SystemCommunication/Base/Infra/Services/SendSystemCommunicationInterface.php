<?php

declare(strict_types=1);

namespace App\Source\SystemCommunication\Base\Infra\Services;

use App\Source\SystemCommunication\Base\Infra\Value\SystemCommunicationValueInterface;

interface SendSystemCommunicationInterface
{
    public function send(SystemCommunicationValueInterface $systemCommunicationValue): void;
}
