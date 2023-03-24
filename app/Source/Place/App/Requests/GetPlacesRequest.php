<?php

namespace App\Source\Place\App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetPlacesRequest extends FormRequest
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
        return [
            'term' => ['required', 'min:3'],
        ];
    }
}
