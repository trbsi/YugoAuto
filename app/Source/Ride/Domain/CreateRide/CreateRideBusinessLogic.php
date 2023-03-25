<?php

declare(strict_types=1);

namespace App\Source\Ride\Domain\CreateRide;

use App\Source\Ride\Infra\CreateRide\Services\CreateRideService;
use Illuminate\Support\Carbon;

class CreateRideBusinessLogic
{
    private CreateRideService $createRideService;

    public function __construct(
        CreateRideService $createRideService
    ) {
        $this->createRideService = $createRideService;
    }

    public function create(
        int $driverId,
        int $fromPlaceId,
        int $toPlaceId,
        Carbon $time,
        int $numberOfSeats,
        int $price,
        ?string $description
    ): void {
        $this->createRideService->create(
            $driverId,
            $fromPlaceId,
            $toPlaceId,
            $time,
            $numberOfSeats,
            $price,
            $description
        );
    }
}
