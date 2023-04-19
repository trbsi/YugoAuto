<?php

namespace App\Actions\Jetstream;

use App\Models\User;
use App\Source\User\Domain\DeleteUser\DeleteUserLogic;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    public function __construct(
        private readonly DeleteUserLogic $deleteUserLogic
    ) {
    }

    /**
     * Delete the given user.
     */
    public function delete(User $user): void
    {
        $this->deleteUserLogic->delete($user);
    }
}
