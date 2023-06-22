<?php

declare(strict_types=1);

namespace App\Source\Ride\Domain\UpdateRide;

use App\Models\Ride;
use App\Source\Ride\Domain\Traits\RideTimeTrait;
use App\Source\Ride\Infra\Common\Specifications\CanAccessRideSpecification;
use App\Source\Ride\Infra\UpdateRide\Services\UpdateRideService;
use Exception;

class UpdateRideLogic
{
    use RideTimeTrait;

    public function __construct(
        private readonly UpdateRideService $updateRideService,
        private readonly CanAccessRideSpecification $canAccessRideSpecification,
    ) {
    }

    public function update(
        int $rideId,
        int $driverId,
        int $numberOfSeats,
        null|string $description,
        bool $isAcceptingPackage,
        null|string $car,
        array $transitPlaces,
        null|int $price,
        null|string $time
    ): void {
        $canAccess = $this->canAccessRideSpecification->isSatisfiedByDriver(driverId: $driverId, rideId: $rideId);

        if (!$canAccess) {
            throw new Exception(__('Cannot access ride'));
        }

        $ride = Ride::find($rideId);

        $timezonedTime = null;
        if ($time) {
            $timezonedTime = $this->getTimezonedTime($time, $ride->country->getCode());
        }

        $this->updateRideService->update(
            numberOfSeats: $numberOfSeats,
            isAcceptingPackage: $isAcceptingPackage,
            description: $description,
            car: $car,
            rideId: $rideId,
            transitPlaces: $transitPlaces,
            price: $price,
            time: $timezonedTime
        );
    }
}
