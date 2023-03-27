<?php

declare(strict_types=1);

namespace App\Source\Messaging\Domain\SendMessage;

use App\Source\Messaging\Infra\SendMessage\Services\SaveMessageService;

class SendMessageLogic
{
    public function __construct(
        private SaveMessageService $saveMessageService
    ) {
    }

    public function send(
        int $senderId,
        int $conversationId,
        string $content
    ): void {
        $this->saveMessageService->save(
            $senderId,
            $conversationId,
            $content
        );
    }
}
