<?php

namespace App\Source\Report\App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportUserRequest extends FormRequest
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
            'report_content' => ['required', 'string'],
            'reported_user_id' => ['required', 'integer', 'exists:users,id'],
        ];
    }

}
