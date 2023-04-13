<?php

namespace App\Source\Auth\App\Requests;

use App\Models\User;
use Laravel\Fortify\Http\Requests\VerifyEmailRequest as BaseVerifyEmailRequest;

class VerifyEmailRequest extends BaseVerifyEmailRequest
{
    public function authorize()
    {
        $user = User::find($this->route('id'));

        if (!hash_equals((string)$user->getKey(), (string)$this->route('id'))) {
            return false;
        }

        if (!hash_equals(sha1($user->getEmailForVerification()), (string)$this->route('hash'))) {
            return false;
        }

        return true;
    }
}
