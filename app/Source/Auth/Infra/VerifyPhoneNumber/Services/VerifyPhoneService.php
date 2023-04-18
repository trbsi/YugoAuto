<?php

declare(strict_types=1);

namespace App\Source\Auth\Infra\VerifyPhoneNumber\Services;

use App\Models\User;

class VerifyPhoneService
{
    public function verify(
        int $userId,
        string $phoneNumber
    ): void {
        $user = User::find($userId);
        $user
            ->setIsPhoneNumberVerified(true)
            ->setPhoneNumber($phoneNumber)
            ->save();
    }
}
