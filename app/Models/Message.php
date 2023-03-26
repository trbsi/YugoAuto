<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation_id',
        'sender_id',
        'recipient_id',
        'content',
        'timestamp',
    ];


    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function getConversationId(): int
    {
        return $this->conversation_id;
    }

    public function setConversationId(int $conversation_id): self
    {
        $this->conversation_id = $conversation_id;
        return $this;
    }

    public function getSenderId(): int
    {
        return $this->sender_id;
    }

    public function setSenderId(int $sender_id): self
    {
        $this->sender_id = $sender_id;
        return $this;
    }

    public function getRecipientId(): int
    {
        return $this->recipient_id;
    }

    public function setRecipientId(int $recipient_id): self
    {
        $this->recipient_id = $recipient_id;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }
}
