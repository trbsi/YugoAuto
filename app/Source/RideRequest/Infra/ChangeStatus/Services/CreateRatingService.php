<?php

namespace App\Source\RideRequest\Infra\ChangeStatus\Services;

use App\Models\Rating;

class CreateRatingService
{
    public function create(
        int $rideId,
        int $driverId,
        int $passengerId
    ): void {
        $model = new Rating();
        $model
            ->setRating(0)
            ->setRideId($rideId)
            ->setPassengerId($passengerId)
            ->setDriverId($driverId)
            ->save();
    }
}
