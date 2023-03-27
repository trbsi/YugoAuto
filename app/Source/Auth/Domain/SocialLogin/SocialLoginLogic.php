<?php

declare(strict_types=1);

namespace App\Source\Auth\Domain\SocialLogin;

use App\Models\User;
use App\Source\Auth\Infra\SocialLogin\Services\CreateUserService;
use App\Source\Auth\Infra\SocialLogin\Services\GetSocialUserService;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginLogic
{
    private GetSocialUserService $getSocialUserService;

    private CreateUserService $createUserService;

    public function __construct(
        GetSocialUserService $getSocialUserService,
        CreateUserService $createUserService
    ) {
        $this->getSocialUserService = $getSocialUserService;
        $this->createUserService = $createUserService;
    }

    public function login(string $driver): User
    {
        $socialUser = Socialite::driver($driver)->user();
        $socialLogin = $this->getSocialUserService->getUser($socialUser->getId(), $driver);

        if ($socialLogin) {
            $user = $socialLogin->user;
        } else {
            $user = $this->createUserService->create($socialUser, $driver);
        }

        return $user;
    }
}
