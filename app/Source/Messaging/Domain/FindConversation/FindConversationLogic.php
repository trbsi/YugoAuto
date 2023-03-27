<?php

declare(strict_types=1);

namespace App\Source\Messaging\Domain\FindConversation;

use App\Models\Conversation;
use App\Source\Messaging\Infra\FindConversation\Services\FindConversationService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FindConversationLogic
{
    public function __construct(
        private FindConversationService $findConversationService
    ) {
    }

    public function findSingleByUserId(int $userId): ?Conversation
    {
        return $this->findConversationService->findByUserId($userId);
    }

    public function findSingleByBetweenTwoUsers(int $userOneId, int $userTwoId): ?Conversation
    {
        return $this->findConversationService->findByBetweenTwoUsers($userOneId, $userTwoId);
    }

    public function findMultipleByUserId(int $userId): LengthAwarePaginator
    {
        return $this->findConversationService->findMultipleByUserId($userId);
    }
}
