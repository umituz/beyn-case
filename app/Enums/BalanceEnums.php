<?php

namespace App\Enums;

/**
 * Class BalanceEnums
 * @package App\Enums
 */
enum BalanceEnums: string
{
    case DEPOSIT_TYPE = 'deposit';
    case WITHDRAW_TYPE = 'withdraw';
}
