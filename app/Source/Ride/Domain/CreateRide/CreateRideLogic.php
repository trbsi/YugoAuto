<?php

declare(strict_types=1);

namespace App\Source\Ride\Domain\CreateRide;

use App\Enum\TimeEnum;
use App\Models\Place;
use App\Source\Ride\Infra\CreateRide\Services\CreateRideService;
use App\Source\Ride\Infra\CreateRide\Specifications\CanCreateRideSpecification;
use DateTimeZone;
use Exception;
use Illuminate\Support\Carbon;

class CreateRideLogic
{
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
        null|string $car
    ): void {
        $place = Place::find($fromPlaceId);
        $country = $place->country;
        $timezones = DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, $country->getCode());
        $timezonedTime = Carbon::createFromFormat(TimeEnum::DATETIME_FORMAT->value, $time, $timezones[0] ?? 'UTC');

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
            car: $car
        );
    }
}
