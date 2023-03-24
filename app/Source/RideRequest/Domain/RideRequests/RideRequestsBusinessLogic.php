<?php

namespace App\Source\RideRequest\Domain\RideRequests;

use App\Models\Ride;
use App\Source\RideRequest\Infra\RideRequests\Services\GetRideRequestsService;
use App\Source\RideRequest\Infra\RideRequests\Specifications\CanAccessRideSpecification;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class RideRequestsBusinessLogic
{
    public function __construct(
        private CanAccessRideSpecification $canAccessRideSpecification,
        private GetRideRequestsService $getRideRequestsService
    ) {
    }

    public function getRequests(int $userId, int $rideId): LengthAwarePaginator
    {
        if (!$this->canAccessRideSpecification->isSatisfied($userId, $rideId)) {
            throw new Exception('Cannot access ride');
        }

        return $this->getRideRequestsService->get($rideId);
    }

    public function getRide(int $rideId): Ride
    {
        return Ride::find($rideId);
    }
}
