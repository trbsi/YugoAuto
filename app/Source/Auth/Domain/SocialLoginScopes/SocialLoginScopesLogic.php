<?php

declare(strict_types=1);

namespace App\Source\Auth\Domain\SocialLoginScopes;

use App\Models\SocialLogin;

class SocialLoginScopesLogic
{
    public function getScopes(string $driver): array
    {
        switch ($driver) {
            case SocialLogin::PROVIDER_FACEBOOK:
                return ['email', 'public_profile'];
            case SocialLogin::PROVIDER_SNAPCHAT:
                return [
                    'https://auth.snapchat.com/oauth2/api/user.display_name',
                    'https://auth.snapchat.com/oauth2/api/user.bitmoji.avatar'
                ];
            default:
                return [];
        }
    }
}
