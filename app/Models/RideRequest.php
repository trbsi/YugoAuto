<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\RideRequest
 *
 * @property int $id
 * @property int $ride_id
 * @property int $user_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Ride $ride
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|RideRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RideRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RideRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|RideRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideRequest whereRideId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RideRequest whereUserId($value)
 * @method static \Database\Factories\RideRequestFactory factory($count = null, $state = [])
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
}
