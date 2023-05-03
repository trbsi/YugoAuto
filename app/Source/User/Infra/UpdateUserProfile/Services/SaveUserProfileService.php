<?php

namespace App\Source\User\Infra\UpdateUserProfile\Services;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class SaveUserProfileService
{
    public function update(array $input, User $user): void
    {
        if ($input['email'] !== $user->getEmail() &&
            $user instanceof MustVerifyEmail
        ) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'phone_number' => $input['phone_number'],
                'is_phone_number_public' => $input['is_phone_number_public'] ?: false,
                'email' => $input['email'],
            ])->save();
        }
    }


    /**
     * Update the given verified user's profile information.
     *
     * @param array<string, string> $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'phone_number' => $input['phone_number'],
            'is_phone_number_public' => $input['is_phone_number_public'] ?: false,
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
