<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\User;

/**
 * Interface OrderRepositoryInterface
 * @package App\Repositories
 */
interface OrderRepositoryInterface
{
    /**
     * @param Order $order
     */
    public function __construct(Order $order);

    /**
     * @return mixed
     */
    public function getAll(): mixed;

    /**
     * @param $data
     * @param User $user
     * @return mixed
     */
    public function create($data, User $user): mixed;

    /**
     * @param $request
     */
    public function getUserOrdersByFilter($request): mixed;

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id): mixed;

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data): mixed;

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id): int;
}
