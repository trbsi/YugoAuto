<?php

declare(strict_types=1);

namespace App\Source\Ride\Domain\CreateRide;

use App\Source\Ride\Infra\CreateRide\Services\CreateRideService;
use App\Source\Ride\Infra\CreateRide\Specifications\CanCreateRideSpecification;
use Exception;
use Illuminate\Support\Carbon;

class CreateRideBusinessLogic
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
        Carbon $time,
        int $numberOfSeats,
        int $price,
        ?string $description
    ): void {
        if (!$this->canCreateRideSpecification->isSatisfied($driverId)) {
            throw new Exception(__('You have active ride for this date. Delete it first'));
        }

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
