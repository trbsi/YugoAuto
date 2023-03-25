<?php

namespace App\Actions\Jetstream;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     */
    public function delete(User $user): void
    {
        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->socialLogins()->delete();
        $user
            ->setEmail(sprintf('anon%s@del.xxx', $user->getId()))
            ->setPhoneNumber(null)
            ->setName('XXX')
            ->setPassword(Hash::make(mt_rand()))
            ->save();
        $user->delete();
    }
}
