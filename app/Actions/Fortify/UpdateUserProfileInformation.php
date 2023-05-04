<?php

namespace App\Actions\Fortify;

use App\Enum\CoreEnum;
use App\Models\User;
use App\Source\User\Domain\UpdateProfilePhoto\UpdateProfilePhotoLogic;
use App\Source\User\Domain\UpdateUserProfile\UpdateUserProfileLogic;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    public function __construct(
        private readonly UpdateProfilePhotoLogic $updateProfilePhotoLogic,
        private readonly UpdateUserProfileLogic $updateUserProfileLogic
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
                    'regex:' . CoreEnum::PHONE_REGEX->value,
                    Rule::unique('users')->ignore($user->id),
                    // user must have this field filled before adding additional phones
                    Rule::requiredIf(!empty($input['additional_phones'])),
                ],
                'is_phone_number_public' => ['nullable', 'boolean'],
                'additional_phones' => ['array', 'nullable'],
                'additional_phones.*.phoneNumber' => [
                    'string',
                    'max:255',
                    Rule::unique('users', 'phone_number')->ignore($user->id),
                    'regex:' . CoreEnum::PHONE_REGEX->value
                ],
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

        $this->updateUserProfileLogic->update($input, $user);
    }

}
