<?php

namespace App\Http\Requests;

/**
 * Class UserRegisterRequest
 * @package App\Http\Request
 */
class UserRegisterRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6'],
            'password_confirmation' => ['required', 'min:6', 'same:password']
        ];
    }
}
