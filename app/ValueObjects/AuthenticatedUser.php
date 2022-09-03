<?php

namespace App\ValueObjects;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Class AuthenticatedUser
 * @package App\ValueObjects
 */
class AuthenticatedUser
{
    private User $user;

    /**
     * @param User $user
     */
    public function __construct(Authenticatable $user)
    {
        $this->user = $user;
    }

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return (float)$this->user->balance;
    }
}
