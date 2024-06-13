<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['string', 'required', 'sometimes', 'unique', 'max:20'],
            'name_thai' => ['string', 'required', 'sometimes'],
            'name_eng' => ['string', 'required', 'sometimes'],
            'email' => ['email', 'required', 'sometimes'],
            'role_id' => ['integer', 'required', 'sometimes'],
        ];
    }
}