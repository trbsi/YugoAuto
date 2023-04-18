<?php

namespace App\Source\Auth\Domain\Enum;

enum PhoneVerificationEnum: string
{
    case  DAILY_LIMIT_GLOBAL_KEY = 'firebase_phone_verification_daily_limit';
    case  DAILY_LIMIT_USER_KEY = 'firebase_phone_verification_user_daily_limit_';
}
