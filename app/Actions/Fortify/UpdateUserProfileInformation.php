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
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:10024'],
        ])->validateWithBag('updateProfileInformation');

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
                'phone_number' => $this->getPhoneNumber($input['phone_number']),
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
            'phone_number' => $this->getPhoneNumber($input['phone_number']),
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }

    private function getPhoneNumber(?string $phoneNumber): ?string
    {
        return null; //TODO remove this when you want to enable phone
        if (!$phoneNumber) {
            return null;
        }

        $phoneNumber = ltrim($phoneNumber, '0');
        $phoneNumber = sprintf('+385%s', $phoneNumber); //TODO hardcoded for HR
        return $phoneNumber;
    }
}
