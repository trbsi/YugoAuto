<?php

declare(strict_types=1);

namespace App\Source\Auth\Domain\Register;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterLogic
{
    public function register(array $input): User
    {
        $user = User::create(
            [
                'username' => $input['username'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]
        );

        if (method_exists($user, 'profile')) {
            $user->profile()->create();
        }

        return $user;
    }
}
