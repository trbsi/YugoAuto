<?php

declare(strict_types=1);

namespace App\Source\Ride\Infra\UpdateRide\Services;

use App\Models\Ride;

class UpdateRideService
{
    public function update(
        int $rideId,
        int $numberOfSeats,
        string $description,
        bool $isAcceptingPackage,
        ?string $car,
    ): void {
        $ride = Ride::find($rideId);
        $ride
            ->setNumberOfSeats($numberOfSeats)
            ->setDescription($description)
            ->setIsAcceptingPackage($isAcceptingPackage)
            ->setCar($car)
            ->save();
    }
}
