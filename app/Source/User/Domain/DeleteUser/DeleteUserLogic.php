<?php

declare(strict_types=1);

namespace App\Source\User\Domain\DeleteUser;

use App\Models\Conversation;
use App\Models\DriverProfile;
use App\Models\Ride;
use App\Models\RideRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DeleteUserLogic
{
    public function delete(User $user): void
    {
        //TODO put this in job
        RideRequest::where('passenger_id', $user->getId())->delete();
        Ride::where('driver_id', $user->getId())->delete();
        Conversation::where('sender_id', $user->getId())->orWhere('recipient_id', $user->getId())->delete();
        DriverProfile::where('user_id', $user->getId())->delete();

        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->socialLogins()->delete();
        $user
            ->setEmail(sprintf('%s@del.xxx', md5((string)(mt_rand() + $user->getId()))))
            ->setPhoneNumber(null)
            ->setName(__('Deleted user'))
            ->setPassword(Hash::make(mt_rand()))
            ->save();
    }
}
