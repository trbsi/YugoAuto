<?php

namespace App\Source\RideRequest\Infra\AcceptOrReject\Services;

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
            ->setDriverId($driverId)
            ->setDriverRating(0)
            ->setPassengerId($passengerId)
            ->setPassengerRating(0)
            ->setRideId($rideId)
            ->save();
    }
}
