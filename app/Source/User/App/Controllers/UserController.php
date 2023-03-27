<?php

namespace App\Source\User\App\Controllers;

use App\Models\User;
use App\Source\User\Domain\GetUser\GetUserLogic;
use Illuminate\Support\Facades\Auth;

class UserController
{
    public function show(int $id)
    {
        $authUserId = Auth::id();
        $user = User::findOrFail($id);

        return view(
            'user.profile',
            compact('user', 'authUserId')
        );
    }
}
