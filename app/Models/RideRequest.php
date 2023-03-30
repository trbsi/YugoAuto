<?php

namespace App\Models;

use App\Source\RideRequest\Enum\RideRequestEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\RideRequest
 *
 * @property int $id
 * @property int $ride_id
 * @property int $passenger_id
 * @property string $status
 * @property string|null $cancelled_time
 * @property int|null $cancelled_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\User $passenger
 * @property-read \App\Models\Ride $ride
 * @method static \Database\Factories\RideRequestFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|RideRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RideRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RideRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|RideRequest whereCancelledBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideRequest whereCancelledTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideRequest wherePassengerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideRequest whereRideId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideRequest whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RideRequest extends Model
{
    use HasFactory;

    public function ride(): BelongsTo
    {
        return $this->belongsTo(Ride::class, 'ride_id', 'id');
    }

    public function passenger(): BelongsTo
    {
        return $this->belongsTo(User::class, 'passenger_id', 'id');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getRideId(): int
    {
        return $this->ride_id;
    }

    public function setRideId(int $ride_id): self
    {
        $this->ride_id = $ride_id;
        return $this;
    }

    public function getPassengerId(): int
    {
        return $this->passenger_id;
    }

    public function setPassengerId(int $passenger_id): self
    {
        $this->passenger_id = $passenger_id;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getCancelledTime(): Carbon
    {
        return $this->cancelled_time;
    }

    public function setCancelledTime(Carbon $cancelled_time): self
    {
        $this->cancelled_time = $cancelled_time;
        return $this;
    }

    public function getCancelledBy(): int
    {
        return $this->cancelled_by;
    }

    public function setCancelledBy(int $cancelled_by): self
    {
        $this->cancelled_by = $cancelled_by;
        return $this;
    }

    public function canBeCancelled(): bool
    {
        return in_array(
            $this->getStatus(),
            [
                RideRequestEnum::ACCEPTED->value
            ]
        );
    }

    public function canBeAcceptedOrRejected(): bool
    {
        return in_array(
            $this->getStatus(),
            [
                RideRequestEnum::PENDING->value
            ]
        );
    }

    public function isAccepted(): bool
    {
        return $this->getStatus() === RideRequestEnum::ACCEPTED->value;
    }
}
