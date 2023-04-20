<?php

declare(strict_types=1);

namespace App\Source\Ride\Infra\DeleteRide\Services;

use App\Models\Ride;

class DeleteRideService
{
    public function delete(Ride $ride): void
    {
        //decrease total rides count only if ride is active
        if ($ride->isActiveRide()) {
            $userProfile = $ride->driver->profile;
            $userProfile
                ->decreaseTotalRidesCount()
                ->save();
        }

        $ride->delete();
    }
}
