<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{
    private Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }
}
