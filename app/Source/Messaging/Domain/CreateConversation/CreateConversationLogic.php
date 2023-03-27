<?php

declare(strict_types=1);

namespace App\Source\Messaging\Domain\CreateConversation;

use App\Source\Messaging\Domain\FindConversation\FindConversationLogic;
use App\Source\Messaging\Domain\SendMessage\SendMessageLogic;
use App\Source\Messaging\Infra\CreateConversation\Services\SaveConversationService;
use App\Source\Messaging\Infra\CreateConversation\Services\UpdateUserProfileService;
use Exception;

class CreateConversationLogic
{
    public function __construct(
        private FindConversationLogic $findConversationLogic,
        private SaveConversationService $saveConversationService,
        private SendMessageLogic $sendMessageLogic,
        private UpdateUserProfileService $updateUserProfileService
    ) {
    }

    public function create(
        int $authUserId,
        int $recipientId,
        string $messageContent
    ): void {
        if ($authUserId === $recipientId) {
            throw new Exception(__('Cannot send message to yourself'));
        }
        $conversation = $this->findConversationLogic->findSingleByBetweenTwoUsers($authUserId, $recipientId);

        if (null === $conversation) {
            $conversation = $this->saveConversationService->save(
                $authUserId,
                $recipientId,
            );

            $this->updateUserProfileService->updateUnreadMessagesCount($recipientId);
        }

        $this->sendMessageLogic->send(
            $authUserId,
            $conversation->getId(),
            $messageContent
        );
        //TODO send email to recipient
    }
}
