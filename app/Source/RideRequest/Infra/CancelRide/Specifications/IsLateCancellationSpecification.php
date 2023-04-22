<?php

declare(strict_types=1);

namespace App\Source\RideRequest\Infra\CancelRide\Specifications;

use App\Models\RideRequest;
use Illuminate\Support\Carbon;

class IsLateCancellationSpecification
{
    private int $rideCancellationThresholdInSeconds;

    public function __construct()
    {
        $this->rideCancellationThresholdInSeconds = (int)config('ride.cancel_ride_threshold_in_hours') * 3600;
    }

    public function isSatisfied(RideRequest $rideRequest): bool
    {
        if (!$rideRequest->isAccepted()) {
            return false;
        }

        $ride = $rideRequest->ride;
        if ($ride->isNonActiveRide()) {
            return false;
        }

        $timeDifferenceInSeconds = $ride->getRideTimeUtc()->timestamp - Carbon::now()->timestamp;
        if ($timeDifferenceInSeconds <= $this->rideCancellationThresholdInSeconds) {
            return true;
        }

        return false;
    }
}
