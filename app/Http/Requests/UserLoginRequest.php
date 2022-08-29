<?php

namespace App\Http\Requests;

/**
 * Class UserLoginRequest
 * @package App\Http\Request
 */
class UserLoginRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users'],
            'password' => ['required', 'min:6']
        ];
    }
}
