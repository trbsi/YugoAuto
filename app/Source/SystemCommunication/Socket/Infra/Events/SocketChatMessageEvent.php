<?php

namespace App\Source\SystemCommunication\Socket\Infra\Events;

use App\Models\Conversation;
use App\Source\Message\Application\Resources\MessageResource;
use App\Source\SystemCommunication\Socket\Infra\Value\SocketChatMessageSystemCommunicationValue;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SocketChatMessageEvent implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public SocketChatMessageSystemCommunicationValue $socketChatMessageNotificationValue;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        SocketChatMessageSystemCommunicationValue $socketChatMessageNotificationValue
    ) {
        $this->socketChatMessageNotificationValue = $socketChatMessageNotificationValue;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('socket_chat_message_channel');
    }

    public function broadcastAs()
    {
        return 'SocketChatMessageNotificationEvent';
    }

    public function broadcastWith()
    {
        $message = $this->socketChatMessageNotificationValue->getMessage();
        $conversation = Conversation::find($message->getConversationId());

        $messageResource = (new MessageResource($message))->toJson();
        $messageResource = json_decode($messageResource, true);
        $messageResource['conversation_identifier'] = $conversation->getConversationIdentifier();
        return $messageResource;
    }
}
