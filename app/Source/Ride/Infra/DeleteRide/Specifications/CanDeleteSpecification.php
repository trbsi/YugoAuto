<?php

declare(strict_types=1);

namespace App\Source\Ride\Infra\DeleteRide\Specifications;

use App\Models\Ride;

class CanDeleteSpecification
{
    public function isSatisfied(int $rideId, int $userId): bool
    {
        $ride = Ride::query()
            ->where('driver_id', $userId)
            ->where('id', $rideId)
            ->first();

        if ($ride === null) {
            return false;
        }

        if ($ride->isNonActiveRide()) {
            return false;
        }

        return true;
    }
}
