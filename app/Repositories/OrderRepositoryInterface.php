<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class OrderRepositoryInterface
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
}
