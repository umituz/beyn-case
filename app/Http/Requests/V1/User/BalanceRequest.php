<?php

namespace App\Http\Requests\V1\User;

use App\Enums\BalanceEnums;
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
            'type' => ['required', 'string', 'in:' . BalanceEnums::DEPOSIT_TYPE . ',' . BalanceEnums::WITHDRAW_TYPE],
            'fullname' => ['required', 'string', 'max:40', 'min:3'],
            'card_number' => ['required', 'numeric', 'min:16'],
            'expiry_month' => ['required', 'numeric', 'min:2'],
            'expiry_year' => ['required', 'numeric', 'min:4'],
            'cvc' => ['required', 'numeric', 'min:3'],
        ];
    }
}
