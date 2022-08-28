<?php

namespace App\Http\Requests;

/**
 * Class UserBalanceV1Request
 * @package App\Http\Request
 */
class UserBalanceV1Request extends Request
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
        ];
    }
}
