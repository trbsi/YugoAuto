<?php

declare(strict_types=1);

namespace App\Source\Ride\Infra\CreateRide\Services;

use App\Models\Ride;
use Illuminate\Support\Carbon;

class CreateRideService
{
    public function create(
        int $driverId,
        int $fromPlaceId,
        int $toPlaceId,
        Carbon $time,
        int $numberOfSeats,
        int $price,
        ?string $description
    ): void {
        $model = new Ride();
        $model
            ->setDriverId($driverId)
            ->setCurrency('EUR')
            ->setPrice($price)
            ->setDescription($description)
            ->setTime($time)
            ->setNumberOfSeats($numberOfSeats)
            ->setFromPlaceId($fromPlaceId)
            ->setToPlaceId($toPlaceId)
            ->save();
    }
}
