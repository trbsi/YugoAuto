<?php

namespace App\Models\DriverProfile;

class AdditionalCarValue
{
    public function __construct(
        private string $carName,
        private string $carPlate
    ) {
    }

    public function getCarName(): string
    {
        return $this->carName;
    }

    public function getCarPlate(): string
    {
        return $this->carPlate;
    }


    public function getCarNameAndPlate(): string
    {
        return sprintf('%s (%s)', $this->getCarName(), $this->getCarPlate());
    }

    public function toArray(): array
    {
        return [
            'carName' => $this->getCarName(),
            'carPlate' => $this->getCarPlate(),
        ];
    }
}
