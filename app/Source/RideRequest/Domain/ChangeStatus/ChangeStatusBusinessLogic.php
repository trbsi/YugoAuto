<?php

namespace App\Source\RideRequest\Domain\ChangeStatus;

use App\Source\RideRequest\Infra\ChangeStatus\Services\ChangeStatusService;
use App\Source\RideRequest\Infra\Common\Specifications\CanAccessRideSpecification;
use Exception;

class ChangeStatusBusinessLogic
{
    public function __construct(
        private CanAccessRideSpecification $canAccessRideSpecification,
        private ChangeStatusService $changeStatusService
    ) {
    }

    public function change(
        int $rideOwnerId,
        int $rideId,
        int $rideRequesterId,
        string $status
    ) {
        if (!$this->canAccessRideSpecification->isSatisfied($rideOwnerId, $rideId)) {
            throw new Exception('Cannot access ride');
        }

        $this->changeStatusService->change(
            $rideId,
            $rideRequesterId,
            $status
        );
        //TODO send email
    }
}
