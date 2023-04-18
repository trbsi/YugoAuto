<?php

declare(strict_types=1);

namespace App\Source\Auth\Domain\VerifyPhoneNumber;

use App\Source\Auth\Infra\VerifyPhoneNumber\Services\IncreaseDailyLimitService;
use App\Source\Auth\Infra\VerifyPhoneNumber\Services\VerifyPhoneService;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class VerifyPhoneNumberLogic
{
    public function __construct(
        private readonly VerifyPhoneService $verifyPhoneService,
        private readonly IncreaseDailyLimitService $increaseDailyLimitService
    ) {
    }

    public function increaseLimits(int $userId): void
    {
        $this->increaseDailyLimitService->increaseGlobalLimit();
        $this->increaseDailyLimitService->increaseUserDailyLimit($userId);
    }

    public function saveVerificationId(
        int $userId,
        string $verificationId,
        string $phoneNumber
    ): void {
        Cache::put(
            $this->getKey($userId, $verificationId, $phoneNumber),
            Carbon::now()->addHours()
        );
    }

    public function verify(
        int $userId,
        string $verificationId,
        string $phoneNumber
    ): void {
        if (!Cache::has($this->getKey($userId, $verificationId, $phoneNumber))) {
            throw new Exception(__('Phone number was not be verified, it took too long'));
        }

        $this->verifyPhoneService->verify($userId, $phoneNumber);
    }

    private function getKey(
        int $userId,
        string $verificationId,
        string $phoneNumber
    ): string {
        return md5($userId . $phoneNumber . $verificationId);
    }
}
