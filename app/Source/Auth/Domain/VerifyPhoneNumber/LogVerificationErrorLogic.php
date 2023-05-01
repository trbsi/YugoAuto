<?php

declare(strict_types=1);

namespace App\Source\Auth\Domain\VerifyPhoneNumber;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class LogVerificationErrorLogic
{
    public function log(
        string $message,
        string $phoneNumberFromInput,
        User $user
    ): void {
        if (empty($message)) {
            return;
        }
        
        Log::warning(
            'PhoneNumberVerificationError',
            [
                'message' => json_decode($message, true),
                'userId' => $user->getId(),
                'phoneNumberFromDb' => $user->getPhoneNumber(),
                'phoneNumberFromInput' => $phoneNumberFromInput
            ]
        );
    }
}
