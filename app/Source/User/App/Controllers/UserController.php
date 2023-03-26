<?php

namespace App\Source\User\App\Controllers;

use App\Source\User\Domain\GetUser\GetUserBusinessLogic;
use Illuminate\Support\Facades\Auth;

class UserController
{
    public function show(int $id, GetUserBusinessLogic $businessLogic)
    {
        $authUserId = Auth::id();
        $user = $businessLogic->get($id);

        return view(
            'user.profile',
            compact('user', 'authUserId')
        );
    }
}
