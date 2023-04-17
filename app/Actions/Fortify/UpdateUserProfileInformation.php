<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Source\User\Domain\UpdateProfilePhoto\UpdateProfilePhotoLogic;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    public function __construct(
        private readonly UpdateProfilePhotoLogic $updateProfilePhotoLogic
    ) {
    }

    /**
     * Validate and update the given user's profile information.
     *
     * @param array<string, string> $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make(
            $input,
            [
                'name' => ['required', 'string', 'max:255'],
                'phone_number' => [
                    'nullable',
                    'string',
                    'max:255',
                    Rule::unique('users')->ignore($user->id),
                    'regex:/^\+[1-9][0-9]{7,14}$/'
                ],
                'is_phone_number_public' => ['nullable', 'boolean'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
                'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:10024'],
            ],
            [
                'regex' => __('validation.phone_number_validation_message')
            ]
        )->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
            $this->updateProfilePhotoLogic->modifyPhoto($user);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
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
