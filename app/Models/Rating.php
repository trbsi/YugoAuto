<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    use HasFactory;

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

    public function getDriverComment(): ?string
    {
        return $this->driver_comment;
    }

    public function setDriverComment(?string $driver_comment): self
    {
        $this->driver_comment = $driver_comment;
        return $this;
    }

    public function getPassengerComment(): ?string
    {
        return $this->passenger_comment;
    }

    public function setPassengerComment(?string $passenger_comment): self
    {
        $this->passenger_comment = $passenger_comment;
        return $this;
    }

    public function isDriverRated(): bool
    {
        return $this->getDriverRating() !== 0;
    }

    public function isPassengerRated(): bool
    {
        return $this->getPassengerRating() !== 0;
    }
}
