<?php

namespace App\Repositories;

use App\Models\Order;
use Exception;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{
    /**
     * @var Order
     */
    private Order $order;

    /**
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @return false|mixed
     */
    public function getAll(): mixed
    {
        try {
            return DB::transaction(function () {
                return Order::paginate();
            });
        } catch (Exception $e) {
            return false;
        }
    }
}
