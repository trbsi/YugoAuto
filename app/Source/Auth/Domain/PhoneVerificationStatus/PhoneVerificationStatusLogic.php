<?php

declare(strict_types=1);

namespace App\Source\Auth\Domain\PhoneVerificationStatus;

use App\Source\Auth\Domain\Enum\PhoneVerificationEnum;
use Illuminate\Support\Facades\Cache;

class PhoneVerificationStatusLogic
{
    private int $phoneVerificationDailyLimit;
    private int $phoneVerificationUserDailyLimit;

    public function __construct()
    {
        $this->phoneVerificationDailyLimit = (int)config('firebase.phone_verification_daily_limit');
        $this->phoneVerificationUserDailyLimit = (int)config('firebase.phone_verification_user_daily_limit');
    }

    public function canVerify(int $userId): bool
    {
        $hasLimit = Cache::has(PhoneVerificationEnum::DAILY_LIMIT_USER_KEY->value . $userId);
        $limit = Cache::get(PhoneVerificationEnum::DAILY_LIMIT_USER_KEY->value . $userId);

        if ($hasLimit && $limit['count'] > $this->phoneVerificationUserDailyLimit) {
            return false;
        }

        $hasLimit = Cache::has(PhoneVerificationEnum::DAILY_LIMIT_GLOBAL_KEY->value);
        $limit = Cache::get(PhoneVerificationEnum::DAILY_LIMIT_GLOBAL_KEY->value);

        if ($hasLimit && $limit['count'] > $this->phoneVerificationDailyLimit) {
            return false;
        }

        return true;
    }
}
