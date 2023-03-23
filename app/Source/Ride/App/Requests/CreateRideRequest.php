<?php

namespace App\Source\Ride\App\Requests;

use App\Enum\TimeEnum;
use Illuminate\Foundation\Http\FormRequest;

class CreateRideRequest extends FormRequest
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
            'from_place_id' => ['required', 'integer'],
            'to_place_id' => ['required', 'integer'],
            'time' => ['required', 'date_format:' . TimeEnum::TIME_FORMAT->value],
            'number_of_seats' => ['required', 'integer'],
            'price' => ['required', 'integer'],
            'description' => ['nullable', 'string', 'max:500'],
        ];
    }

}
