<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * @param User $user
     */
    public function __construct(User $user);

    /**
     * @return mixed
     */
    public function getAll(): mixed;
}
