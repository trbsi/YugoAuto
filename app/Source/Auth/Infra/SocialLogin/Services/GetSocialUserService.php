<?php

declare(strict_types=1);

namespace App\Source\Auth\Infra\SocialLogin\Services;

use App\Models\SocialLogin;

class GetSocialUserService
{
    public function getUser(string $socialUserId, string $provider): ?SocialLogin
    {
        return SocialLogin::where('provider_id', $socialUserId)
            ->where('provider', $provider)
            ->first();
    }
}
