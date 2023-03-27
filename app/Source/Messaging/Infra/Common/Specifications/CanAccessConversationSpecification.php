<?php

declare(strict_types=1);

namespace App\Source\Messaging\Infra\Common\Specifications;

use App\Models\Conversation;
use Illuminate\Database\Eloquent\Builder;

class CanAccessConversationSpecification
{
    public function isSatisfied(int $conversationId, int $userId): bool
    {
        return Conversation::where('id', $conversationId)
                ->where(function (Builder $query) use ($userId) {
                    $query
                        ->where('sender_id', $userId)
                        ->orWhere('recipient_id', $userId);
                })
                ->count() > 0;
    }
}
