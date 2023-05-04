<?php

namespace App\Models\DriverProfile;

class AdditionalCarsCollection
{
    private array $additionalCars;

    public function __construct(
        AdditionalCarValue ...$additionalCars
    ) {
        $this->additionalCars = $additionalCars;
    }

    public function getCars(): array
    {
        return $this->additionalCars;
    }

    public function isEmpty(): bool
    {
        if (empty($this->getCars())) {
            return true;
        }

        if (empty($this->filterEmptyCars())) {
            return true;
        }

        return false;
    }

    public function toArray(): array
    {
        return array_map(
            static fn(AdditionalCarValue $car) => $car->toArray(),
            $this->filterEmptyCars()
        );
    }

    private function filterEmptyCars(): array
    {
        return array_values(
            array_filter(
                $this->additionalCars,
                static fn(AdditionalCarValue $phone): bool => !empty(
                    $phone->getCarName()
                    ) && !empty($phone->getCarPlate())
            )
        );
    }
}
