<?php

namespace App\Models;

use App\Enum\TimeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Rating
 *
 * @property int $id
 * @property int $ride_id
 * @property int $driver_id
 * @property int $driver_rating Given by passenger
 * @property string|null $driver_comment Given by passenger
 * @property int $passenger_id
 * @property int $passenger_rating Given by driver
 * @property string|null $passenger_comment Given by driver
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $driver
 * @property-read \App\Models\User $passenger
 * @property-read \App\Models\Ride $ride
 * @method static \Database\Factories\RatingFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Rating newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rating newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rating query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereDriverComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereDriverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereDriverRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating wherePassengerComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating wherePassengerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating wherePassengerRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereRideId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Rating extends Model
{
    use HasFactory;

    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id', 'id');
    }

    public function passenger(): BelongsTo
    {
        return $this->belongsTo(User::class, 'passenger_id', 'id');
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

    /**
     * Given by a passenger
     */
    public function getDriverRating(): int
    {
        return $this->driver_rating;
    }

    public function setDriverRating(int $driver_rating): self
    {
        $this->driver_rating = $driver_rating;
        return $this;
    }

    /**
     * Given by a driver
     */
    public function getPassengerRating(): int
    {
        return $this->passenger_rating;
    }

    public function setPassengerRating(int $passenger_rating): self
    {
        $this->passenger_rating = $passenger_rating;
        return $this;
    }

    /**
     * Given by a passenger
     */
    public function getDriverComment(): ?string
    {
        return $this->driver_comment;
    }

    public function setDriverComment(?string $driver_comment): self
    {
        $this->driver_comment = empty($driver_comment) ? null : $driver_comment;;
        return $this;
    }

    /**
     * Given by a driver
     */
    public function getPassengerComment(): ?string
    {
        return $this->passenger_comment;
    }

    public function setPassengerComment(?string $passenger_comment): self
    {
        $this->passenger_comment = empty($passenger_comment) ? null : $passenger_comment;
        return $this;
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->updated_at;
    }

    public function getUpdatedAtFormatted(): string
    {
        return $this->getUpdatedAt()->format(TimeEnum::DATE_FORMAT->value);
    }

    public function getCreatedAt(): Carbon
    {
        return $this->created_at;
    }

    public function isDriverRated(): bool
    {
        return $this->getDriverRating() !== 0;
    }

    public function isPassengerRated(): bool
    {
        return $this->getPassengerRating() !== 0;
    }

    public function getRatedUser(): User
    {
        if ($this->getDriverId() === Auth::id()) {
            return $this->passenger;
        }

        return $this->driver;
    }

    public function isCurrentUserDriver(): bool
    {
        return $this->getDriverId() === Auth::id();
    }

    public function isCurrentUserPassenger(): bool
    {
        return $this->getPassengerId() === Auth::id();
    }

    public function getOtherUser(): User
    {
        if ($this->getDriverId() === Auth::id()) {
            return $this->passenger;
        }

        return $this->driver;
    }

    public function getRatingForUser(int $userId): int
    {
        if ($this->getDriverId() === $userId) {
            return $this->getDriverRating();
        }

        return $this->getPassengerRating();
    }

    public function getCommentForUser(int $userId): ?string
    {
        if ($this->getDriverId() === $userId) {
            return $this->getDriverComment();
        }

        return $this->getPassengerComment();
    }
}
