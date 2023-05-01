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

    public function verifyPhoneNumber(
        string $type,
        int $userId,
        string $verificationId,
        string $phoneNumber
    ): void {
        switch ($type) {
            case 'code-sent':
                $this->saveVerificationId(
                    userId: $userId,
                    verificationId: $verificationId,
                    phoneNumber: $phoneNumber
                );
                break;
            case 'verify':
                $this->verify(
                    userId: $userId,
                    verificationId: $verificationId,
                    phoneNumber: $phoneNumber
                );
                break;
            default:
                throw new Exception(__('Whoops! Something went wrong.'));
        }
    }


    private function saveVerificationId(
        int $userId,
        string $verificationId,
        string $phoneNumber
    ): void {
        Cache::put(
            $this->getKey($userId, $verificationId, $phoneNumber),
            Carbon::now()->addHours()
        );
    }

    private function verify(
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
