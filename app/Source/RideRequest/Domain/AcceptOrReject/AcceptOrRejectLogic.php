<?php

namespace App\Source\RideRequest\Domain\AcceptOrReject;

use App\Models\RideRequest;
use App\Source\RideRequest\Domain\NotifyUser\NotifyUserLogic;
use App\Source\RideRequest\Enum\RideRequestEnum;
use App\Source\RideRequest\Infra\AcceptOrReject\Services\ChangeStatusService;
use App\Source\RideRequest\Infra\AcceptOrReject\Services\CreateRatingService;
use App\Source\RideRequest\Infra\Common\Services\UpdatePendingRequestsCountService;
use App\Source\RideRequest\Infra\Common\Specifications\CanAccessRideSpecification;
use Exception;

class AcceptOrRejectLogic
{
    public function __construct(
        private readonly CanAccessRideSpecification $canAccessRideSpecification,
        private readonly ChangeStatusService $changeStatusService,
        private readonly CreateRatingService $createRatingService,
        private readonly UpdatePendingRequestsCountService $updatePendingRequestsCountService
    ) {
    }

    public function acceptOrReject(
        int $driverId,
        int $rideRequestId,
        string $status
    ) {
        //you can only accept or reject here
        if (!in_array($status, [RideRequestEnum::ACCEPTED->value, RideRequestEnum::REJECTED->value])) {
            throw new Exception('You cannot change the status');
        }

        /** @var RideRequest $rideRequest */
        $rideRequest = RideRequest::findOrFail($rideRequestId);

        //only driver can accept and reject
        if (!$this->canAccessRideSpecification->isSatisfiedByDriver($driverId, $rideRequest->getRideId())) {
            throw new Exception('Cannot access ride');
        }

        $rideRequest = $this->changeStatusService->change(
            rideRequest: $rideRequest,
            status: $status
        );

        if ($rideRequest->isAccepted()) {
            $this->createRatingService->create(
                rideId: $rideRequest->getRideId(),
                driverId: $driverId,
                passengerId: $rideRequest->getPassengerId()
            );
        }

        $this->updatePendingRequestsCountService->decrease($rideRequest->ride);
        NotifyUserLogic::notifyPassengerAboutAcceptOrReject($rideRequest);
    }
}
