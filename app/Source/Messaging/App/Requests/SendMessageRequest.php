<?php

namespace App\Source\Messaging\App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest
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
            'conversation_id' => ['required', 'integer', 'exists:conversations,id'],
            'message_content' => ['required', 'string'],
        ];
    }

}
