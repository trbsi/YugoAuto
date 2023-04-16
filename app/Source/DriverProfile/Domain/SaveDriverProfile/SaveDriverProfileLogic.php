<?php

declare(strict_types=1);

namespace App\Source\DriverProfile\Domain\SaveDriverProfile;

use App\Source\DriverProfile\Infra\SaveDriverProfile\Services\SaveDriverProfileService;

class SaveDriverProfileLogic
{
    public function __construct(
        private readonly SaveDriverProfileService $saveDriverProfileService
    ) {
    }

    public function save(
        int $userId,
        string $carName,
        string $carPlate,
        bool $animals,
        bool $smoking
    ) {
        $this->saveDriverProfileService->save(
            userId: $userId,
            carName: $carName,
            carPlate: $carPlate,
            animals: $animals,
            smoking: $smoking
        );
    }
}
