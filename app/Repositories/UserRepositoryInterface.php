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

    public function create($data);

    public function getUserById($id);

    public function updateUserById($data, User $user);
}
