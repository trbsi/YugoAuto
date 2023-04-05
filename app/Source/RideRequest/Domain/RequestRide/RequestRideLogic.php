<?php

namespace App\Source\RideRequest\Domain\RequestRide;

use App\Models\Ride;
use App\Source\RideRequest\Domain\NotifyUser\NotifyUserLogic;
use App\Source\RideRequest\Infra\Common\Services\UpdatePendingRequestsCountService;
use App\Source\RideRequest\Infra\RequestRide\Services\SaveRideRequestService;
use App\Source\RideRequest\Infra\RequestRide\Specifications\CanSendRequestSpecification;
use App\Source\RideRequest\Infra\RequestRide\Specifications\IsRideRequestedSpecification;
use Exception;

class RequestRideLogic
{
    public function __construct(
        private readonly IsRideRequestedSpecification $isRideRequestedSpecification,
        private readonly SaveRideRequestService $saveRideRequestService,
        private readonly CanSendRequestSpecification $canSendRequestSpecification,
        private readonly UpdatePendingRequestsCountService $updatePendingRequestsCountService
    ) {
    }

    public function requestRide(
        int $passengerId,
        int $rideId
    ): void {
        if ($this->isRideRequestedSpecification->isSatisfied($passengerId, $rideId)) {
            throw new Exception(__('Ride is already requested'));
        }

        if (!$this->canSendRequestSpecification->isSatisfied($passengerId, $rideId)) {
            throw new Exception(__('You cannot request for yourself'));
        }

        $ride = Ride::findOrFail($rideId);

        if ($ride->isFilled()) {
            throw new Exception(__('Ride is filled'));
        }

        $rideRequest = $this->saveRideRequestService->save($passengerId, $rideId);
        $this->updatePendingRequestsCountService->increase($ride);
        NotifyUserLogic::notifyDriverAboutRideRequest($ride, $rideRequest);
    }
}
