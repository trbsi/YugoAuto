<?php

declare(strict_types=1);

namespace App\Source\Messaging\Domain\SendMessage;

use App\Models\Conversation;
use App\Source\Messaging\Domain\NotifyUser\NotifyUserLogic;
use App\Source\Messaging\Infra\Common\Services\UpdateConversationService;
use App\Source\Messaging\Infra\Common\Services\UpdateUserProfileService;
use App\Source\Messaging\Infra\Common\Specifications\CanAccessConversationSpecification;
use App\Source\Messaging\Infra\SendMessage\Services\SaveMessageService;
use Exception;

class SendMessageLogic
{
    public function __construct(
        private SaveMessageService $saveMessageService,
        private CanAccessConversationSpecification $canAccessConversationSpecification,
        private UpdateUserProfileService $updateUserProfileService,
        private UpdateConversationService $updateConversationService
    ) {
    }

    public function send(
        int $senderId,
        int $conversationId,
        string $content
    ): void {
        if (!$this->canAccessConversationSpecification->isSatisfied($conversationId, $senderId)) {
            throw new Exception(__('Cannot access conversation'));
        }

        $message = $this->saveMessageService->save(
            $senderId,
            $conversationId,
            $content
        );

        $conversation = Conversation::findOrFail($conversationId);
        $conversation = $this->updateConversationService->markConversationAsUnread($conversation, $senderId);
        $this->updateUserProfileService->increaseUnreadMessagesCount($conversation->getOtherUser()->getId());

        NotifyUserLogic::notifyRecipient(
            conversation: $conversation,
            lastMessage: $message,
            sender: $conversation->getMe(),
            recipient: $conversation->getOtherUser()
        );
    }
}
