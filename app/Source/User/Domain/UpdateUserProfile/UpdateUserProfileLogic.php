<?php

namespace App\Source\User\Domain\UpdateUserProfile;

use App\Models\User;
use App\Source\User\Infra\UpdateUserProfile\Services\SaveAdditionalPhonesService;
use App\Source\User\Infra\UpdateUserProfile\Services\SaveUserProfileService;

class UpdateUserProfileLogic
{
    public function __construct(
        private readonly SaveUserProfileService $saveUserProfileService,
        private readonly SaveAdditionalPhonesService $saveAdditionalPhonesService
    ) {
    }

    public function update(array $input, User $user): void
    {
        $this->saveUserProfileService->update(
            input: $input,
            user: $user
        );

        $this->saveAdditionalPhonesService->update(
            input: $input,
            user: $user
        );
    }

}
