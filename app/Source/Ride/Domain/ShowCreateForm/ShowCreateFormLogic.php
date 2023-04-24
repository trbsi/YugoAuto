<?php

declare(strict_types=1);

namespace App\Source\Ride\Domain\ShowCreateForm;

use App\Source\DriverProfile\Infra\DriverProfile\Specifications\IsDriverProfileFilledSpecification;
use App\Source\User\Infra\BasicUserInfo\Specifications\IsBasicUserInfoFilledSpecification;

class ShowCreateFormLogic
{
    public function __construct(
        private readonly IsDriverProfileFilledSpecification $isDriverProfileFilledSpecification,
        private readonly IsBasicUserInfoFilledSpecification $isBasicUserInfoFilledSpecification
    ) {
    }

    public function canCreateRide(int $userId): bool
    {
        return
            $this->isBasicUserInfoFilledSpecification->isSatisfied($userId) &&
            $this->isDriverProfileFilledSpecification->isSatisfied($userId);
    }
}
