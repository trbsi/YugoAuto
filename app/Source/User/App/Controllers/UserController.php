<?php

namespace App\Source\User\App\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController
{
    public function show(int $id)
    {
        $authUserId = Auth::id();
        $user = User::with(['profile', 'driverProfile'])
            ->findOrFail($id);

        return view(
            'user.profile.profile',
            compact('user', 'authUserId')
        );
    }
}
