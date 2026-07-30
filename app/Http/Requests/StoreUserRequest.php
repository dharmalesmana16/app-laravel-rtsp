<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user');

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('users')->ignore($userId),
            ],
            'password' => [$userId ? 'nullable' : 'required', 'string', 'min:8'],
            'role' => ['required', Rule::in(['admin', 'user'])],
        ];
    }
}
