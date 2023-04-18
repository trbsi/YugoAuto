<?php

namespace App\Source\Auth\App\Requests;

use App\Enum\CoreEnum;
use Illuminate\Foundation\Http\FormRequest;

class VerifyPhoneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'verification_id' => ['required', 'string'],
            'phone_number' => ['required', 'string', 'regex:' . CoreEnum::PHONE_REGEX->value],
        ];
    }
}
