<?php

declare(strict_types=1);

namespace App\Source\RideRequest\Infra\CancelRide\Services;

use App\Models\Rating;
use App\Models\RideRequest;

class RatingService
{
    public function remove(RideRequest $rideRequest): void
    {
        $ride = $rideRequest->ride;
        Rating::where('ride_id', $ride->getId())
            ->where('driver_id', $ride->getDriverId())
            ->where('passenger_id', $rideRequest->getPassengerId())
            ->delete();
    }

    public function setLateCancellationRating(RideRequest $rideRequest): void
    {
        $ride = $rideRequest->ride;
        $rating = Rating::where('ride_id', $ride->getId())
            ->where('driver_id', $ride->getDriverId())
            ->where('passenger_id', $rideRequest->getPassengerId())
            ->first();

        //leave negative comment for driver, but positive for a passenger
        if ($rating->getDriverId() === $rideRequest->getCancelledByUserId()) {
            $rating
                ->setDriverComment($this->getFormattedComment($rideRequest))
                ->setPassengerRating(5);
        } //leave negative comment for a passenger, but positive for a driver
        else {
            $rating
                ->setPassengerComment($this->getFormattedComment($rideRequest))
                ->setDriverRating(5);
        }

        $rating->save();
    }

    private function getFormattedComment(RideRequest $rideRequest): string
    {
        $cancelledTime = $rideRequest->getCancelledTime();
        $rideTime = $rideRequest->ride->getRideTimeUtc();

        $diffInHours = $rideTime->diffInHours($cancelledTime);
        $diffInMinutes = $rideTime->diffInMinutes($cancelledTime);

        if ($diffInHours !== 0) {
            $hours = floor($diffInMinutes / 60);
            $remainingMinutes = fmod($diffInMinutes, 60);

            return __('Cancelled too late in hours and minutes', [
                'hours' => $hours,
                'minutes' => $remainingMinutes
            ]);
        }

        return __('Cancelled too late in minutes', [
            'minutes' => $diffInMinutes
        ]);
    }
}
