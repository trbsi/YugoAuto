<?php

declare(strict_types=1);

namespace App\Source\DriverProfile\Infra\DriverProfile\Specifications;

use App\Models\DriverProfile;

class IsDriverProfileFilledSpecification
{
    public function isSatisfied(int $driverId): bool
    {
        return DriverProfile::where('user_id', $driverId)->count() > 0;
    }
}
