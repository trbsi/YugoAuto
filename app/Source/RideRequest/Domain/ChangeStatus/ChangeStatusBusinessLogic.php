<?php

namespace App\Source\RideRequest\Domain\ChangeStatus;

use App\Source\RideRequest\Enum\RideRequestEnum;
use App\Source\RideRequest\Infra\ChangeStatus\Services\ChangeStatusService;
use App\Source\RideRequest\Infra\ChangeStatus\Services\CreateRatingService;
use App\Source\RideRequest\Infra\Common\Specifications\CanAccessRideSpecification;
use Exception;

class ChangeStatusBusinessLogic
{
    public function __construct(
        private CanAccessRideSpecification $canAccessRideSpecification,
        private ChangeStatusService $changeStatusService,
        private CreateRatingService $createRatingService
    ) {
    }

    public function change(
        int $driverId,
        int $rideId,
        int $passengerId,
        string $status
    ) {
        if (!$this->canAccessRideSpecification->isSatisfied($driverId, $rideId)) {
            throw new Exception('Cannot access ride');
        }

        $this->changeStatusService->change(
            $rideId,
            $passengerId,
            $status
        );

        if ($status === RideRequestEnum::ACCEPTED->value) {
            $this->createRatingService->create(
                $rideId,
                $driverId,
                $passengerId
            );
        }
        //TODO send email
    }
}
