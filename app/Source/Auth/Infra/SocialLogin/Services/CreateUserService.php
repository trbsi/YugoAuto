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
        $username = $this->getUsername($socialUser);

        $user = new User();
        $user
            ->setUsername($username)
            ->setSocialEmail($socialUser->getEmail() ?? null)
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

    private function getUsername(SocialiteUser $socialUser): string
    {
        if ($socialUser->getNickname()) {
            $username = $socialUser->getNickname();
        } else {
            if ($socialUser->getName()) {
                $username = $socialUser->getName();
            } else {
                $username = 'user' . rand(0, 1000);
            }
        }

        $username = Str::slug($username);

        do {
            $userCount = User::where('username', $username)->count();

            if ($userCount > 0) {
                $username = sprintf('%s%s', $username, rand(0, 1000));
            }
        } while ($userCount > 0);

        return $username;
    }
}
