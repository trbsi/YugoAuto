<?php

declare(strict_types=1);

namespace App\Source\User\Infra\BasicUserInfo\Specifications;

use App\Models\User;

class IsBasicUserInfoFilledSpecification
{
    public function isSatisfied(int $userId): bool
    {
        $user = User::find($userId);

        if (
            $user->hasProfilePhoto() &&
            $user->hasPhoneNumber() &&
            $user->hasName()
        ) {
            return true;
        }

        return false;
    }
}
