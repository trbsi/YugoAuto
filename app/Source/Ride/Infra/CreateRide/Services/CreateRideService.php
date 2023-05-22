<?php

declare(strict_types=1);

namespace App\Source\Ride\Infra\CreateRide\Services;

use App\Models\Country;
use App\Models\Ride;
use App\Source\Localization\Infra\Helpers\LocalizationHelper;
use Illuminate\Support\Carbon;

class CreateRideService
{
    public function create(
        int $driverId,
        int $fromPlaceId,
        int $toPlaceId,
        Carbon $time,
        int $numberOfSeats,
        int $price,
        ?string $description,
        bool $isAcceptingPackage,
        Country $country,
        null|string $car,
        array $transitPlaces
    ): void {
        $ride = new Ride();
        $ride
            ->setDriverId($driverId)
            ->setCurrency($this->getCurrency($country))
            ->setCountryId($country->getId())
            ->setPrice($price)
            ->setDescription($description)
            ->setRideTime($time)
            ->setRideTimeUtc($time->clone()->utc())
            ->setNumberOfSeats($numberOfSeats)
            ->setFromPlaceId($fromPlaceId)
            ->setToPlaceId($toPlaceId)
            ->setIsAcceptingPackage($isAcceptingPackage)
            ->setCar($car)
            ->save();

        $userProfile = $ride->driver->profile;
        $userProfile
            ->increaseTotalRidesCount()
            ->save();

        if ($transitPlaces) {
            $ride->transitPlaces()->attach($transitPlaces);
        }
    }

    private function getCurrency(Country $country): string
    {
        if ($currency = LocalizationHelper::getCurrency()) {
            return $currency;
        }

        return $country->getCurrency();
    }
}
