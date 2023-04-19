<?php

namespace App\Source\RideRequest\App\Requests;

use App\Source\RideRequest\Enum\RideRequestEnum;
use Illuminate\Foundation\Http\FormRequest;

class AcceptOrRejectRideRequest extends FormRequest
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
            'status' => ['required', 'in:' . implode(',', RideRequestEnum::values())],
        ];
    }

}
