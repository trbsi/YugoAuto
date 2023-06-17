<?php

namespace App\Source\Ride\App\Requests;

use App\Enum\TimeEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRideRequest extends FormRequest
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
            'ride_id' => ['required', 'integer'],
            'number_of_seats' => ['required', 'integer', 'min:1', 'max:10'],
            'description' => ['nullable', 'string', 'max:500'],
            'is_accepting_package' => ['nullable', 'string', 'in:on'],
            'car' => ['nullable', 'string', 'max:50'],
            'transit_places_ids' => ['nullable', 'string'],
            'price' => ['nullable', 'integer', 'max:10000'],
            'time' => ['nullable', 'date_format:' . TimeEnum::DATETIME_FORMAT->value],
        ];
    }

}
