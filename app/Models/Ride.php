<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Ride extends Model
{
    use HasFactory;

    private int $id;
    private int $user_id;
    private int $from_place_id;
    private int $to_place_id;
    private int $price;
    private int $number_of_seats;
    private string $description;

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

    public function setTime(Carbon $time): self
    {
        $this->time = $time;
        return $this;
    }
}

