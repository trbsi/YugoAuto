<?php

declare(strict_types=1);

namespace App\Source\Ride\Infra\UpdateRide\Services;

use App\Models\Ride;
use Illuminate\Support\Carbon;

class UpdateRideService
{
    public function update(
        int $rideId,
        int $numberOfSeats,
        null|string $description,
        bool $isAcceptingPackage,
        null|string $car,
        array $transitPlaces,
        null|int $price,
        null|Carbon $time
    ): void {
        $ride = Ride::find($rideId);

        if ($price && !$ride->acceptedRideRequests->count()) {
            $ride->setPrice($price);
        }

        if ($time && !$ride->acceptedRideRequests->count()) {
            $ride
                ->setRideTime($time)
                ->setRideTimeUtc($time->utc());
        }

        $ride
            ->setNumberOfSeats($numberOfSeats)
            ->setDescription($description)
            ->setIsAcceptingPackage($isAcceptingPackage)
            ->setCar($car)
            ->save();

        if ($transitPlaces) {
            $ride->transitPlaces()->sync($transitPlaces);
        }
    }
}
