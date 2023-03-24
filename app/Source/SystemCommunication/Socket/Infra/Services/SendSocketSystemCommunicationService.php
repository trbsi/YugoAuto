<?php

declare(strict_types=1);

namespace App\Source\SystemCommunication\Socket\Infra\Services;

use App\Source\SystemCommunication\Base\Infra\Exceptions\SystemCommunicationTypeNotSupportedException;
use App\Source\SystemCommunication\Base\Infra\Services\SendSystemCommunicationInterface;
use App\Source\SystemCommunication\Base\Infra\Value\SystemCommunicationValueInterface;
use App\Source\SystemCommunication\Socket\Infra\Events\SocketChatMessageEvent;
use App\Source\SystemCommunication\Socket\Infra\Value\SocketChatMessageSystemCommunicationValue;

class SendSocketSystemCommunicationService implements SendSystemCommunicationInterface
{
    /**
     * @param SocketChatMessageSystemCommunicationValue $communicationValue
     */
    public function send(SystemCommunicationValueInterface $communicationValue): void
    {
        switch (true) {
            case ($communicationValue instanceof SocketChatMessageSystemCommunicationValue):
                SocketChatMessageEvent::dispatch($communicationValue);
                break;
            default:
                throw new SystemCommunicationTypeNotSupportedException('Socket notification type not supported');
        }
    }
}
