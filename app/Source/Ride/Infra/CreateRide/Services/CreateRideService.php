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
        $ride = new Ride();
        $ride
            ->setDriverId($driverId)
            ->setCurrency('EUR')
            ->setPrice($price)
            ->setDescription($description)
            ->setRideTime($time)
            ->setRideTimeUtc($time->clone()->utc())
            ->setNumberOfSeats($numberOfSeats)
            ->setFromPlaceId($fromPlaceId)
            ->setToPlaceId($toPlaceId)
            ->save();

        $userProfile = $ride->driver->profile;
        $userProfile
            ->increaseTotalRidesCount()
            ->save();
    }
}
