<?php

namespace App\Source\RideRequest\Infra\AcceptOrReject\Services;

use App\Models\RideRequest;

class ChangeStatusService
{
    public function change(
        int $rideId,
        int $passengerId,
        string $status
    ): RideRequest {
        $model = RideRequest::where('ride_id', $rideId)
            ->where('passenger_id', $passengerId)
            ->first();

        $model
            ->setStatus($status)
            ->save();

        return $model;
    }
}
