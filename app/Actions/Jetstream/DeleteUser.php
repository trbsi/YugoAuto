<?php

namespace App\Actions\Jetstream;

use App\Models\Message;
use App\Models\Ride;
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
        Ride::where('driver_id', $user->getId())->delete();
        Message::where('sender_id', $user->getId())->delete();

        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->socialLogins()->delete();
        $user
            ->setEmail(sprintf('%s@del.xxx', md5(time() + $user->getId())))
            ->setPhoneNumber(null)
            ->setName(md5(time()))
            ->setPassword(Hash::make(mt_rand()))
            ->save();
        $user->delete();
    }
}
