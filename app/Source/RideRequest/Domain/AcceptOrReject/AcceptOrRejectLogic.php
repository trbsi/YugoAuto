<?php

namespace App\Source\RideRequest\Domain\AcceptOrReject;

use App\Source\RideRequest\Domain\NotifyUser\NotifyUserLogic;
use App\Source\RideRequest\Enum\RideRequestEnum;
use App\Source\RideRequest\Infra\AcceptOrReject\Services\ChangeStatusService;
use App\Source\RideRequest\Infra\AcceptOrReject\Services\CreateRatingService;
use App\Source\RideRequest\Infra\Common\Specifications\CanAccessRideSpecification;
use Exception;

class AcceptOrRejectLogic
{
    public function __construct(
        private CanAccessRideSpecification $canDriverAccessRideSpecification,
        private ChangeStatusService $changeStatusService,
        private CreateRatingService $createRatingService
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
            throw new Exception('You cannot set status to pending or cancelled');
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

        NotifyUserLogic::notifyPassengerAboutAcceptOrReject($rideRequest);
    }
}
