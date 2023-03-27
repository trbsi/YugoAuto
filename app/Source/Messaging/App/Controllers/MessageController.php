<?php

declare(strict_types=1);

namespace App\Source\Messaging\App\Controllers;

use App\Http\Controllers\Controller;
use App\Source\Messaging\App\Requests\SendMessageRequest;
use App\Source\Messaging\Domain\ListMessages\ListMessagesLogic;
use App\Source\Messaging\Domain\SendMessage\SendMessageLogic;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function send(
        SendMessageRequest $request,
        SendMessageLogic $logic
    ) {
        try {
            $logic->send(
                Auth::id(),
                (int)$request->conversation_id,
                $request->message_content
            );
        } catch (Exception $e) {
            $request->session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

    public function list(
        int $conversationId,
        Request $request,
        ListMessagesLogic $listMessageLogic
    ) {
        try {
            $messages = $listMessageLogic->list(Auth::id(), $conversationId);
            $otherUser = $listMessageLogic->getOtherUser($conversationId);
            return view(
                'messaging.message.list',
                compact('messages', 'otherUser', 'conversationId')
            );
        } catch (Exception $e) {
            $request->session()->flash('error', __('Cannot access conversation'));
            return redirect(route('messaging.conversation.list'));
        }
    }
}
