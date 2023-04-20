<?php

declare(strict_types=1);

namespace App\Source\Ride\Domain\DeleteRide;

use App\Models\Ride;
use App\Source\Ride\Infra\DeleteRide\Services\DeleteRideService;
use App\Source\Ride\Infra\DeleteRide\Specifications\CanDeleteSpecification;
use App\Source\RideRequest\Infra\Common\Services\UpdatePendingRequestsCountService;
use Exception;

class DeleteRideLogic
{
    public function __construct(
        private readonly CanDeleteSpecification $canDeleteSpecification,
        private readonly UpdatePendingRequestsCountService $updatePendingRequestsCountService,
        private readonly DeleteRideService $deleteRideService
    ) {
    }

    public function delete(int $rideId, int $userId): void
    {
        if (!$this->canDeleteSpecification->isSatisfied($rideId, $userId)) {
            throw new Exception('Cannot delete ride');
        }

        $ride = Ride::find($rideId);
        $this->updatePendingRequestsCountService->setToZero($ride);
        $this->deleteRideService->delete($ride);
    }
}
