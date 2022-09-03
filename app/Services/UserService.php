<?php

namespace App\Services;

use App\Enums\BalanceEnums;
use App\ValueObjects\AuthenticatedUser;

/**
 * Class UserService
 * @package App\Services
 */
class UserService
{
    /**
     * @param $balance
     * @param $amount
     * @param $type
     * @return mixed
     */
    public function getBalanceByType($balance, $amount, $type): mixed
    {
        if ($type === BalanceEnums::DEPOSIT_TYPE) {
            $balance = $balance + $amount;
        }

        if ($type === BalanceEnums::WITHDRAW_TYPE) {
            $balance = $balance - $amount;
        }

        return $balance;
    }

    /**
     * @return float
     */
    public static function getBalance(): float
    {
        $authenticatedUser = new AuthenticatedUser(auth()->user());

        return $authenticatedUser->getBalance();
    }
}
