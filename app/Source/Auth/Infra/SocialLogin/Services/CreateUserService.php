<?php

declare(strict_types=1);

namespace App\Source\Auth\Infra\SocialLogin\Services;

use App\Models\SocialLogin;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class CreateUserService
{
    public function create(SocialiteUser $socialUser, string $driver): User
    {
        $user = new User();
        $user
            ->setName($this->getName($socialUser))
            ->setEmail($socialUser->getEmail() ?? null)
            ->setPassword(Hash::make(Str::random()))
            ->setEmailVerifiedAt(Carbon::now())
            ->save();

        $socialLogin = new SocialLogin();
        $socialLogin
            ->setProvider($driver)
            ->setProviderId($socialUser->getId());

        $user->socialLogins()->save($socialLogin);

        if (method_exists($user, 'profile')) {
            $user->profile()->create();
        }

        return $user;
    }

    private function getName(SocialiteUser $socialUser): string
    {
        $name = $socialUser->getName();
        $exploded = explode(' ', $name);
        return $exploded[0] ?? 'Name';
    }
}
