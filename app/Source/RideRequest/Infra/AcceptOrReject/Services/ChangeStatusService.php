<?php

namespace App\Source\RideRequest\Infra\AcceptOrReject\Services;

use App\Models\RideRequest;

class ChangeStatusService
{
    public function change(
        RideRequest $rideRequest,
        string $status
    ): RideRequest {
        $rideRequest
            ->setStatus($status)
            ->save();

        if ($rideRequest->isAccepted()) {
            $userProfile = $rideRequest->passenger->profile;
            $userProfile
                ->increaseTotalRidesCount()
                ->save();
        }

        return $rideRequest;
    }
}
