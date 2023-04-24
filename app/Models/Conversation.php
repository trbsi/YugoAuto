<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;


/**
 * App\Models\Conversation
 *
 * @property int $id
 * @property int $sender_id
 * @property int $recipient_id
 * @property int $sender_read
 * @property int $recipient_read
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Message> $messages
 * @property-read int|null $messages_count
 * @property-read \App\Models\User $recipient
 * @property-read \App\Models\User $sender
 * @method static \Database\Factories\ConversationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereRecipientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereRecipientRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereSenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereSenderRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Message> $messages
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Message> $messages
 * @mixin \Eloquent
 */
class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function recipient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recipient_id', 'id');
    }

    public function getId(): int
    {
        return $this->id;
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

    public function isSenderRead(): bool
    {
        return $this->sender_read;
    }

    public function setSenderRead(bool $sender_read): self
    {
        $this->sender_read = $sender_read;
        return $this;
    }

    public function isRecipientRead(): bool
    {
        return $this->recipient_read;
    }

    public function setRecipientRead(bool $recipient_read): self
    {
        $this->recipient_read = $recipient_read;
        return $this;
    }

    public function getOtherUser(?int $authUserId = null): User
    {
        $authUserId = (null === $authUserId) ? Auth::id() : $authUserId;

        if ($this->getSenderId() === $authUserId) {
            return $this->recipient;
        }

        return $this->sender;
    }

    public function getMe(): User
    {
        if ($this->getSenderId() === Auth::id()) {
            return $this->sender;
        }

        return $this->recipient;
    }

    public function isReadByCurrentUser(): bool
    {
        if ($this->getSenderId() === Auth::id()) {
            return $this->isSenderRead();
        }

        return $this->isRecipientRead();
    }
}
