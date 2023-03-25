<?php

namespace App\Source\User\Domain\GetUser;

use App\Models\User;

class GetUserBusinessLogic
{
    public function get(int $id): User
    {
        return User::findOrFail($id);
    }
}
