<?php

namespace App\Source\RideRequest\Domain\CancelRide;

use App\Models\RideRequest;
use App\Source\RideRequest\Domain\NotifyUser\NotifyUserLogic;
use App\Source\RideRequest\Infra\CancelRide\Services\CancelRideService;
use App\Source\RideRequest\Infra\CancelRide\Services\RatingService;
use App\Source\RideRequest\Infra\CancelRide\Specifications\CanCancelRideSpecification;
use App\Source\RideRequest\Infra\CancelRide\Specifications\IsLateCancellationSpecification;
use App\Source\RideRequest\Infra\Common\Services\UpdatePendingRequestsCountService;
use Exception;

class CancelRideLogic
{
    public function __construct(
        private readonly CanCancelRideSpecification $canCancelRideSpecification,
        private readonly CancelRideService $cancelRideService,
        private readonly RatingService $ratingService,
        private readonly IsLateCancellationSpecification $isLateCancellationSpecification,
        private readonly UpdatePendingRequestsCountService $updatePendingRequestsCountService
    ) {
    }

    public function cancel(
        int $authUserId,
        int $rideRequestId
    ): RideRequest {
        $rideRequest = RideRequest::findOrFail($rideRequestId);
        $ride = $rideRequest->ride;

        $canCancel = $this->canCancelRideSpecification->satisfiedBy(
            authUserId: $authUserId,
            rideRequest: $rideRequest,
            ride: $ride
        );

        if (!$canCancel) {
            throw new Exception('You cannot cancel this ride');
        }

        if ($this->isLateCancellationSpecification->isSatisfied($rideRequest)) {
            $this->ratingService->setLateCancellationRating($rideRequest);
            $this->cancelRideService->increaseLastMinuteCancellation($authUserId);
        } else {
            $this->ratingService->remove($rideRequest);
            $this->cancelRideService->decreaseRidesCountForPassenger($rideRequest);
        }

        //driver can only reject/accept and then cancel, when driver accepts/rejects count will be decreased
        //but here if passenger cancels while request is pending then we need to decrease count
        if ($rideRequest->amIPassenger() && $rideRequest->isPending()) {
            $this->updatePendingRequestsCountService->decreaseForDriver($ride);
        }

        $rideRequest = $this->cancelRideService->cancel(
            rideRequest: $rideRequest,
            authUserId: $authUserId
        );

        NotifyUserLogic::sendCancellationNotification($rideRequest, $authUserId);

        return $rideRequest;
    }
}
