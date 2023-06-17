<?php

declare(strict_types=1);

namespace App\Source\Ride\Domain\UpdateRide;

use App\Models\Ride;
use App\Source\Ride\Infra\Common\Specifications\CanAccessRideSpecification;
use App\Source\Ride\Infra\UpdateRide\Services\GetRideService;
use Exception;

class GetRideLogic
{
    public function __construct(
        private readonly CanAccessRideSpecification $canAccessRideSpecification,
        private readonly GetRideService $getRideService
    ) {
    }

    public function getById(int $rideId, int $userId): Ride
    {
        $canAccess = $this->canAccessRideSpecification->isSatisfiedByDriver(driverId: $userId, rideId: $rideId);

        if (!$canAccess) {
            throw new Exception(__('Cannot access ride'));
        }

        return $this->getRideService->getById($rideId);
    }
}
