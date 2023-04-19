<?php

namespace App\Source\RideRequest\Infra\CancelRide\Services;

use App\Models\RideRequest;
use App\Models\UserProfile;
use App\Source\RideRequest\Enum\RideRequestEnum;
use Illuminate\Support\Carbon;

class CancelRideService
{
    public function cancel(
        RideRequest $rideRequest,
        int $authUserId
    ): RideRequest {
        $rideRequest
            ->setStatus(RideRequestEnum::CANCELLED->value)
            ->setCancelledByUserId($authUserId)
            ->setCancelledTime(Carbon::now())
            ->save();

        return $rideRequest;
    }

    public function decreaseRidesCount(RideRequest $rideRequest): void
    {
        //decrease for a passenger
        $profile = $rideRequest->passenger->profile;
        $profile
            ->decreaseTotalRidesCount()
            ->save();
    }

    public function increaseLastMinuteCancellation(int $authUserId): void
    {
        $profile = UserProfile::where('user_id', $authUserId)->first();
        $profile
            ->increaseLastMinuteCancelledRidesCount()
            ->save();
    }
}
