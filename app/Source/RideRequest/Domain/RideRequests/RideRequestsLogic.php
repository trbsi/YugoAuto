<?php

namespace App\Source\RideRequest\Domain\RideRequests;

use App\Models\Ride;
use App\Source\Ride\Infra\Common\Specifications\CanAccessRideSpecification;
use App\Source\RideRequest\Infra\RideRequests\Services\GetRideRequestsService;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class RideRequestsLogic
{
    public function __construct(
        private CanAccessRideSpecification $canAccessRideSpecification,
        private GetRideRequestsService     $getRideRequestsService
    )
    {
    }

    public function getRequests(int $userId, int $rideId): LengthAwarePaginator
    {
        $canAccess = $this->canAccessRideSpecification->isSatisfiedByDriverOrPassenger(
            userId: $userId,
            rideId: $rideId
        );
        if (!$canAccess) {
            throw new Exception(__('Cannot access ride'));
        }

        return $this->getRideRequestsService->get($rideId);
    }

    public function getRide(int $rideId): Ride
    {
        return Ride::with([
            'driver.driverProfile',
            'rideRequestForAuthUser',
            'fromPlace',
            'toPlace'
        ])->find($rideId);
    }
}
