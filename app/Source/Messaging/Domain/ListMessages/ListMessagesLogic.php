<?php

declare(strict_types=1);

namespace App\Source\Messaging\Domain\ListMessages;

use App\Models\Conversation;
use App\Models\User;
use App\Source\Messaging\Infra\Common\Specifications\CanAccessConversationSpecification;
use App\Source\Messaging\Infra\ListMessages\Services\GetMessagesService;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListMessagesLogic
{
    public function __construct(
        private CanAccessConversationSpecification $canAccessConversationSpecification,
        private GetMessagesService $getMessagesService
    ) {
    }

    public function list(int $conversationId, int $userId): LengthAwarePaginator
    {
        if (!$this->canAccessConversationSpecification->isSatisfied($conversationId, $userId)) {
            throw new Exception(__('Cannot access conversation'));
        }

        return $this->getMessagesService->get($conversationId);
    }

    public function getOtherUser(int $conversationId): User
    {
        $conversation = Conversation::findOrFail($conversationId);
        return $conversation->getOtherUser();
    }
}
