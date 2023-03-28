<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Rating
 *
 * @property int $id
 * @property int $giver_id
 * @property int $taker_id
 * @property int $ride_id
 * @property int $rating
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $giver
 * @property-read \App\Models\Ride $ride
 * @property-read \App\Models\User $taker
 * @method static \Illuminate\Database\Eloquent\Builder|Rating newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rating newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rating query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereGiverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereRideId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereTakerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereUpdatedAt($value)
 * @property int $driver_id
 * @property int $passenger_id
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereDriverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating wherePassengerId($value)
 * @mixin \Eloquent
 */
class Rating extends Model
{
    use HasFactory;

    public function giver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'giver_id', 'id');
    }

    public function taker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'taker_id', 'id');
    }

    public function ride(): BelongsTo
    {
        return $this->belongsTo(Ride::class, 'ride_id', 'id');
    }

    public function getId(): int
    {
        return $this->id;
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

    public function getDriverId(): int
    {
        return $this->driver_id;
    }

    public function setDriverId(int $driver_id): self
    {
        $this->driver_id = $driver_id;
        return $this;
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

    public function getDriverRating(): int
    {
        return $this->driver_rating;
    }

    public function setDriverRating(int $driver_rating): self
    {
        $this->driver_rating = $driver_rating;
        return $this;
    }

    public function getPassengerRating(): int
    {
        return $this->passenger_rating;
    }

    public function setPassengerRating(int $passenger_rating): self
    {
        $this->passenger_rating = $passenger_rating;
        return $this;
    }
}
