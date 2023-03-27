<?php

declare(strict_types=1);

namespace App\Source\Messaging\Infra\FindConversation\Services;

use App\Models\Conversation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class FindConversationService
{
    public function findByUserId(int $userId): ?Conversation
    {
        return Conversation::where('sender_id', $userId)
            ->orWhere('recipient_id', $userId)
            ->first();
    }

    public function findByBetweenTwoUsers(int $userOneId, int $userTwoId): ?Conversation
    {
        //TODO - check query index
        return Conversation::where(function (Builder $query) use ($userOneId, $userTwoId) {
            $query
                ->where('sender_id', $userOneId)
                ->where('recipient_id', $userTwoId);
        })
            ->orWhere(function (Builder $query) use ($userOneId, $userTwoId) {
                $query
                    ->where('sender_id', $userTwoId)
                    ->where('recipient_id', $userOneId);
            })
            ->first();
    }

    public function findMultipleByUserId(int $userId): LengthAwarePaginator
    {
        return Conversation::where('sender_id', $userId)
            ->orWhere('recipient_id', $userId)
            ->with(['recipient', 'sender'])
            ->orderBy('updated_at', 'DESC')
            ->paginate();
    }
}
