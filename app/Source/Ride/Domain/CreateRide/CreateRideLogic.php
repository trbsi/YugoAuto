<?php

declare(strict_types=1);

namespace App\Source\Ride\Domain\CreateRide;

use App\Models\Place;
use App\Source\Ride\Domain\Traits\RideTimeTrait;
use App\Source\Ride\Infra\CreateRide\Services\CreateRideService;
use App\Source\Ride\Infra\CreateRide\Specifications\CanCreateRideSpecification;
use Exception;

class CreateRideLogic
{
    use RideTimeTrait;

    public function __construct(
        private CreateRideService $createRideService,
        private CanCreateRideSpecification $canCreateRideSpecification
    ) {
    }

    public function create(
        int $driverId,
        int $fromPlaceId,
        int $toPlaceId,
        string $time,
        int $numberOfSeats,
        int $price,
        ?string $description,
        bool $isAcceptingPackage,
        null|string $car,
        array $transitPlaces
    ): void {
        $place = Place::find($fromPlaceId);
        $country = $place->country;
        $timezonedTime = $this->getTimezonedTime($time, $country->getCode());

        $canCreate = $this->canCreateRideSpecification->isSatisfied(
            driverId: $driverId,
            creationTime: $timezonedTime,
            fromPlaceId: $fromPlaceId,
            toPlaceId: $toPlaceId
        );
        if (!$canCreate) {
            throw new Exception(__('You have active ride for this date. Delete it first'));
        }

        $this->createRideService->create(
            driverId: $driverId,
            fromPlaceId: $fromPlaceId,
            toPlaceId: $toPlaceId,
            time: $timezonedTime,
            numberOfSeats: $numberOfSeats,
            price: $price,
            description: $description,
            isAcceptingPackage: $isAcceptingPackage,
            country: $country,
            car: $car,
            transitPlaces: $transitPlaces
        );
    }
}
