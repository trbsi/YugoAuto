<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserProfile
 *
 * @property int $id
 * @property int $user_id
 * @property int $rating
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereUserId($value)
 * @method static \Database\Factories\UserProfileFactory factory($count = null, $state = [])
 * @property int $rating_sum
 * @property int $rating_count
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereRatingCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereRatingSum($value)
 * @property int $unread_messages_count
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereUnreadMessagesCount($value)
 * @mixin \Eloquent
 */
class UserProfile extends Model
{
    use HasFactory;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function getRatingSum(): int
    {
        return $this->rating_sum;
    }

    public function setRatingSum(int $rating_sum): self
    {
        $this->rating_sum = $rating_sum;
        return $this;
    }

    public function getRatingCount(): int
    {
        return $this->rating_count;
    }

    public function setRatingCount(int $rating_count): self
    {
        $this->rating_count = $rating_count;
        return $this;
    }

    public function getRating(): float
    {
        if ($this->getRatingCount() === 0) {
            return 0;
        }

        return round($this->getRatingSum() / $this->getRatingCount(), 2);
    }

    public function getUnreadMessagesCount(): int
    {
        return $this->unread_messages_count;
    }

    public function setUnreadMessagesCount(int $unread_messages_count): self
    {
        $this->unread_messages_count = $unread_messages_count;
        return $this;
    }
}
