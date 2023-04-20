<?php

namespace App\Source\RideRequest\App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CancelRideRequest extends FormRequest
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
            'ride_request_id' => ['required', 'integer', 'exists:ride_requests,id'],
        ];
    }

}
