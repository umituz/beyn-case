<?php

namespace App\Http\Requests\V1\User;

use App\Http\Requests\Request;

/**
 * Class BalanceRequest
 * @package App\Http\Requests\V1\User
 */
class BalanceRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'amount' => ['required', 'numeric'],
            'type' => ['required', 'string'],
        ];
    }
}
