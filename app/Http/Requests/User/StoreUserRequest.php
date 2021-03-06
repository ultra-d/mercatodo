<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:100', 'regex:/[^a-zA-ZÑñ\s]+$ /i'],
            'email' => ['required', 'email', 'max:100', Rule::unique('users', 'email')->ignore($this->user)],
            'password' => ['required', 'confirmed'],
        ];
    }
}
