<?php

declare(strict_types=1);

namespace App\Source\DriverProfile\Infra\SaveDriverProfile\Services;

use App\Models\DriverProfile;

class SaveDriverProfileService
{
    public function save(
        int $userId,
        string $carName,
        string $carPlate,
        bool $animals,
        bool $smoking
    ) {
        $model = DriverProfile::where('user_id', $userId)->first();
        if (null === $model) {
            $model = new DriverProfile();
        }
        
        $model
            ->setUserId($userId)
            ->setCarPlate($carPlate)
            ->setCarName($carName)
            ->setSmoking($smoking)
            ->setAnimals($animals)
            ->save();
    }
}
