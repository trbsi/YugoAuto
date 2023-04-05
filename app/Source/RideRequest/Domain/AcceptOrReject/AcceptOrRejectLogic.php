<?php

namespace App\Source\RideRequest\Domain\AcceptOrReject;

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
        private readonly CanAccessRideSpecification $canDriverAccessRideSpecification,
        private readonly ChangeStatusService $changeStatusService,
        private readonly CreateRatingService $createRatingService,
        private readonly UpdatePendingRequestsCountService $updatePendingRequestsCountService
    ) {
    }

    public function acceptOrReject(
        int $driverId,
        int $rideId,
        int $passengerId,
        string $status
    ) {
        //you can only accept or reject here
        if (!in_array($status, [RideRequestEnum::ACCEPTED->value, RideRequestEnum::REJECTED->value])) {
            throw new Exception('You cannot change the status');
        }

        //only driver can accept and reject
        if (!$this->canDriverAccessRideSpecification->isSatisfiedByDriver($driverId, $rideId)) {
            throw new Exception('Cannot access ride');
        }


        $rideRequest = $this->changeStatusService->change(
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

        $this->updatePendingRequestsCountService->decrease($rideRequest->ride);

        NotifyUserLogic::notifyPassengerAboutAcceptOrReject($rideRequest);
    }
}
