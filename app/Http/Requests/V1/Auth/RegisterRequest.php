<?php

namespace App\Http\Requests\V1\Auth;

use App\Http\Requests\Request;

/**
 * Class RegisterRequest
 * @package App\Http\Requests\V1\Auth
 */
class RegisterRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6'],
            'password_confirmation' => ['required', 'min:6', 'same:password']
        ];
    }
}
