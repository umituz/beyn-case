<?php

namespace App\Http\Requests\V1\Auth;

use App\Http\Requests\Request;

/**
 * Class LoginRequest
 * @package App\Http\Requests\V1\Auth
 */
class LoginRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6']
        ];
    }
}
