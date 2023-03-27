<?php

declare(strict_types=1);

namespace App\Source\Messaging\App\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Source\Messaging\App\Requests\CreateConversationRequest;
use App\Source\Messaging\Domain\CreateConversation\CreateConversationLogic;
use App\Source\Messaging\Domain\FindConversation\FindConversationLogic;
use App\Source\Messaging\Domain\ListConversations\ListConversationsLogic;
use Exception;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    public function createForm(
        int $userId
    ) {
        $user = User::findOrFail($userId);
        return view('messaging.conversation.compose', compact('user'));
    }

    public function create(
        CreateConversationRequest $request,
        CreateConversationLogic $logic
    ) {
        try {
            $logic->create(
                Auth::id(),
                (int)$request->receiver_id,
                $request->message_content
            );
            $request->session()->flash('success', __('Message sent'));
            return redirect(route('messaging.conversation.list'));
        } catch (Exception $e) {
            $request->session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function list(
        FindConversationLogic $logic
    ) {
        $conversations = $logic->findMultipleByUserId(Auth::id());
        return view(
            'messaging.conversation.list',
            compact('conversations')
        );
    }
}
