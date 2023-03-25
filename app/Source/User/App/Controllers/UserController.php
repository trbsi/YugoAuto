<?php

namespace App\Source\User\App\Controllers;

use App\Source\User\Domain\GetUser\GetUserBusinessLogic;

class UserController
{
    public function show(int $id, GetUserBusinessLogic $businessLogic)
    {
        $user = $businessLogic->get($id);

        return view('user.profile', compact('user'));
    }
}
