<?php

declare(strict_types=1);

namespace App\Source\Ride\Domain\DeleteRide;

use App\Models\Ride;
use App\Source\Ride\Infra\DeleteRide\Specifications\CanDeleteSpecification;
use Exception;

class DeleteRideLogic
{
    private CanDeleteSpecification $canDeleteSpecification;

    public function __construct(
        CanDeleteSpecification $canDeleteSpecification
    ) {
        $this->canDeleteSpecification = $canDeleteSpecification;
    }

    public function delete(int $rideId, int $userId): void
    {
        if (!$this->canDeleteSpecification->isSatisfied($rideId, $userId)) {
            throw new Exception('Cannot delete ride');
        }

        Ride::find($rideId)->delete();
    }
}
