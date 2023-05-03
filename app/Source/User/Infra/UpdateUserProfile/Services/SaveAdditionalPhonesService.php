<?php

namespace App\Source\User\Infra\UpdateUserProfile\Services;

use App\Models\User;
use App\Models\User\AdditionalPhonesCollection;
use App\Models\User\AdditionalPhoneValue;

class SaveAdditionalPhonesService
{
    public function update(array $input, User $user): void
    {
        $phones = array_map(
            static fn(array $phone): AdditionalPhoneValue => new AdditionalPhoneValue(
                $phone['phoneNumber'],
                $phone['isVerified'] ?? false
            ),
            $input['additional_phones']
        );

        $user
            ->setAdditionalPhones(new AdditionalPhonesCollection(...$phones))
            ->save();
    }
}
