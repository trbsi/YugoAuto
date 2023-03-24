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

    public function getGiverId(): int
    {
        return $this->giver_id;
    }

    public function setGiverId(int $giver_id): self
    {
        $this->giver_id = $giver_id;
        return $this;
    }

    public function getTakerId(): int
    {
        return $this->taker_id;
    }

    public function setTakerId(int $taker_id): self
    {
        $this->taker_id = $taker_id;
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

    public function getRating(): int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;
        return $this;
    }
}
