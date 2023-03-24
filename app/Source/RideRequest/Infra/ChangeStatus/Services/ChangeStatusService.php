<?php

namespace App\Source\RideRequest\Infra\ChangeStatus\Services;

use App\Models\RideRequest;

class ChangeStatusService
{
    public function change(
        int $rideId,
        int $rideRequesterId,
        string $status
    ): void {
        $model = RideRequest::where('ride_id', $rideId)
            ->where('user_id', $rideRequesterId)
            ->first();

        $model
            ->setStatus($status)
            ->save();
    }
}
