<?php

declare(strict_types=1);

namespace App\Source\RideRequest\Infra\CancelRide\Specifications;

use App\Models\Ride;
use Illuminate\Support\Carbon;

class IsLateCancellationSpecification
{
    private int $rideCancellationThresholdInSeconds;

    public function __construct()
    {
        $this->rideCancellationThresholdInSeconds = (int)config('ride.cancel_ride_threshold_in_hours') * 3600;
    }

    public function isSatisfied(Ride $ride): bool
    {
        $timeDifferenceInSeconds = $ride->getRideTimeUtc()->timestamp - Carbon::now()->timestamp;

        //somehow ride time is lower than current time
        if ($timeDifferenceInSeconds < 0) {
            return false;
        }

        if ($timeDifferenceInSeconds <= $this->rideCancellationThresholdInSeconds) {
            return true;
        }

        return false;
    }
}
