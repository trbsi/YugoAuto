<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Ride
 *
 * @property int $id
 * @property int $user_id
 * @property int $from_place_id
 * @property int $to_place_id
 * @property Carbon $time
 * @property int $price
 * @property string $currency
 * @property int $number_of_seats
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\Place $fromPlace
 * @property-read \App\Models\Place $toPlace
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\RideFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Ride newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ride newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ride query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ride whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ride whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ride whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ride whereFromPlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ride whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ride whereNumberOfSeats($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ride wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ride whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ride whereToPlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ride whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ride whereUserId($value)
 * @mixin \Eloquent
 */
class Ride extends Model
{
    use HasFactory;

    protected $casts = [
        'time' => 'datetime'
    ];

    public function fromPlace(): BelongsTo
    {
        return $this->belongsTo(Place::class, 'from_place_id', 'id');
    }

    public function toPlace(): BelongsTo
    {
        return $this->belongsTo(Place::class, 'to_place_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

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

    public function getFromPlaceId(): int
    {
        return $this->from_place_id;
    }

    public function setFromPlaceId(int $from_place_id): self
    {
        $this->from_place_id = $from_place_id;
        return $this;
    }

    public function getToPlaceId(): int
    {
        return $this->to_place_id;
    }

    public function setToPlaceId(int $to_place_id): self
    {
        $this->to_place_id = $to_place_id;
        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function getNumberOfSeats(): int
    {
        return $this->number_of_seats;
    }

    public function setNumberOfSeats(int $number_of_seats): self
    {
        $this->number_of_seats = $number_of_seats;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getTime(): Carbon
    {
        return $this->time;
    }


    public function getTimeFormatted(): string
    {
        return $this->getTime()->format('d.m.Y. H:i');
    }

    public function setTime(Carbon $time): self
    {
        $this->time = $time;
        return $this;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;
        return $this;
    }
}
