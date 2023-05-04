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
            'from_place_id' => ['required', 'integer', 'exists:places,id'],
            'to_place_id' => ['required', 'integer', 'exists:places,id'],
            'time' => ['required', 'date_format:' . TimeEnum::DATETIME_FORMAT->value],
            'number_of_seats' => ['required', 'integer', 'min:1', 'max:10'],
            'price' => ['required', 'integer', 'max:10000'],
            'description' => ['nullable', 'string', 'max:500'],
            'is_accepting_package' => ['nullable', 'string', 'in:on'],
            'car' => ['nullable', 'string', 'max:50'],
        ];
    }

}
