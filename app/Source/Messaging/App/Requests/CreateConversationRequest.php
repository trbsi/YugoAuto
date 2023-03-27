<?php

namespace App\Source\Messaging\App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateConversationRequest extends FormRequest
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
            'receiver_id' => ['required', 'integer', 'exists:users,id'],
            'message_content' => ['required', 'string'],
        ];
    }

}
