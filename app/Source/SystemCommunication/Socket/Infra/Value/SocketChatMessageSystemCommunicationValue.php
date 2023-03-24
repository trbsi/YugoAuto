<?php

declare(strict_types=1);

namespace App\Source\SystemCommunication\Socket\Infra\Value;

use App\Models\Message;
use App\Source\SystemCommunication\Base\Infra\Value\SystemCommunicationValueInterface;

final class SocketChatMessageSystemCommunicationValue implements SystemCommunicationValueInterface,
                                                                 SocketSystemCommunicationValueInterface
{
    private Message $message;

    public function __construct(
        Message $message
    ) {
        $this->message = $message;
    }

    public function getMessage(): Message
    {
        return $this->message;
    }
}
