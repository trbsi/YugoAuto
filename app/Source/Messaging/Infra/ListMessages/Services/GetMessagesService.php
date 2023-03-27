<?php

declare(strict_types=1);

namespace App\Source\Messaging\Infra\ListMessages\Services;

use App\Models\Message;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetMessagesService
{
    public function get(int $conversationId): LengthAwarePaginator
    {
        return Message::where('conversation_id', $conversationId)
            ->orderBy('id', 'desc')
            ->with(['sender'])
            ->paginate(10);
    }
}
