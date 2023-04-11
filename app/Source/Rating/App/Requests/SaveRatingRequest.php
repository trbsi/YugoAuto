<?php

namespace App\Source\Rating\App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveRatingRequest extends FormRequest
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
            'stars' => ['required', 'integer', 'min:1', 'max:5'],
            'ride_id' => ['required', 'integer', 'exists:rides,id'],
            'comment' => ['nullable', 'string', 'max:500'],
            'user_to_be_rated_id' => ['required', 'exists:users,id'],
        ];
    }

}
