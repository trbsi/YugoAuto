<?php

namespace App\Source\PushToken\App\Requests;

use App\Models\PushToken;
use Illuminate\Foundation\Http\FormRequest;

class SavePushTokenRequest extends FormRequest
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
            'deviceId' => ['required'],
            'platform' => ['required', 'in:' . implode(',', [PushToken::PLATFORM_IOS, PushToken::PLATFORM_ANDROID])],
            'token' => ['required'],
            'tokenType' => ['nullable', 'in:' . PushToken::TOKEN_TYPE_FIREBASE],
        ];
    }
}
