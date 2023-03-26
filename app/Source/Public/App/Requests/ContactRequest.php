<?php

namespace App\Source\Public\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $isGuest = Auth::guest();

        $rules = [
            'message' => ['required'],
        ];

        if ($isGuest) {
            $rules['name'] = ['required'];
            $rules['email'] = ['required'];
        }

        return $rules;
    }
}
