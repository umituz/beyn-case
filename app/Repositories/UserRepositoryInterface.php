<?php

namespace App\Repositories;

use App\Models\User;

/**
 * Interface UserRepositoryInterface
 * @package App\Repositories
 */
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

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param $id
     * @return mixed
     */
    public function getUserById($id);

    /**
     * @param $data
     * @param User $user
     * @return mixed
     */
    public function updateUserById($data, User $user);
}
