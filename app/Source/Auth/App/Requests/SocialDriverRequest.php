<?php

namespace App\Source\Auth\App\Requests;

use App\Models\SocialLogin;
use Illuminate\Foundation\Http\FormRequest;

class SocialDriverRequest extends FormRequest
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
            'driver' => 'in:' . implode(',', SocialLogin::getProviders()),
        ];
    }

    public function prepareForValidation()
    {
        $this->merge(['driver' => $this->route('driver')]);
    }
}
