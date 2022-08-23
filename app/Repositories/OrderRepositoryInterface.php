<?php

namespace App\Repositories;

use App\Models\Order;

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
}
