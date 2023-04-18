<?php

declare(strict_types=1);

namespace App\Source\Auth\Infra\VerifyPhoneNumber\Services;

use App\Source\Auth\Domain\Enum\PhoneVerificationEnum;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class IncreaseDailyLimitService
{
    public function increaseGlobalLimit(): void
    {
        $this->increaseLimit(PhoneVerificationEnum::DAILY_LIMIT_GLOBAL_KEY->value);
    }

    public function increaseUserDailyLimit(int $userId): void
    {
        $this->increaseLimit(PhoneVerificationEnum::DAILY_LIMIT_USER_KEY->value . $userId);
    }

    private function increaseLimit(string $key): void
    {
        if (Cache::has($key)) {
            $dailyLimit = Cache::get($key);
            $dailyLimit['count'] = $dailyLimit['count'] + 1;
        } else {
            $dailyLimit = [
                'count' => 0,
                'cacheTime' => Carbon::now()->addHours(24)
            ];
        }

        Cache::put(
            $key,
            $dailyLimit,
            $dailyLimit['cacheTime']
        );
    }

}
