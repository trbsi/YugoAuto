<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserProfile
 *
 * @property int $id
 * @property int $user_id
 * @property int $rating_sum
 * @property int $rating_count
 * @property int $unread_messages_count
 * @property int $pending_requests_count
 * @property int $total_rides_count
 * @property int $last_minute_cancelled_rides_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\UserProfileFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereLastMinuteCancelledRidesCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile wherePendingRequestsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereRatingCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereRatingSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereTotalRidesCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereUnreadMessagesCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereUserId($value)
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

    public function getPendingRequestsCount(): int
    {
        return $this->pending_requests_count;
    }

    public function setPendingRequestsCount(int $pending_requests_count): self
    {
        $this->pending_requests_count = $pending_requests_count;
        return $this;
    }

    public function increasePendingRequestsCount(): self
    {
        $this->setPendingRequestsCount($this->getPendingRequestsCount() + 1);
        return $this;
    }

    public function decreasePendingRequestsCount(): self
    {
        //do not go below 0
        if ($this->getPendingRequestsCount() > 0) {
            $this->setPendingRequestsCount($this->getPendingRequestsCount() - 1);
        }
        return $this;
    }

    public function getTotalRidesCount(): int
    {
        return $this->total_rides_count;
    }

    public function setTotalRidesCount(int $total_rides_count): self
    {
        $this->total_rides_count = $total_rides_count;
        return $this;
    }

    public function increaseTotalRidesCount(): self
    {
        $this->setTotalRidesCount($this->getTotalRidesCount() + 1);
        return $this;
    }

    public function decreaseTotalRidesCount(): self
    {
        if ($this->getTotalRidesCount() > 0) {
            $this->setTotalRidesCount($this->getTotalRidesCount() - 1);
        }
        return $this;
    }

    public function getLastMinuteCancelledRidesCount(): int
    {
        return $this->last_minute_cancelled_rides_count;
    }

    public function setLastMinuteCancelledRidesCount(int $last_minute_cancelled_rides_count): self
    {
        $this->last_minute_cancelled_rides_count = $last_minute_cancelled_rides_count;
        return $this;
    }

    public function increaseLastMinuteCancelledRidesCount(): self
    {
        $this->setLastMinuteCancelledRidesCount($this->getLastMinuteCancelledRidesCount() + 1);
        return $this;
    }

    public function getLastMinuteCancelledRidesPercentage(): int
    {
        if ($this->getTotalRidesCount() === 0 || $this->getLastMinuteCancelledRidesCount() === 0) {
            return 0;
        }

        return (int)($this->getLastMinuteCancelledRidesCount() / $this->getTotalRidesCount() * 100);
    }
}
