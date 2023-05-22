<?php

declare(strict_types=1);

namespace App\Source\Ride\Infra\UpdateRide\Services;

use App\Models\Ride;

class UpdateRideService
{
    public function update(
        int $rideId,
        int $numberOfSeats,
        null|string $description,
        bool $isAcceptingPackage,
        null|string $car,
        array $transitPlaces
    ): void {
        $ride = Ride::find($rideId);
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
