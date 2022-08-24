<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\User;
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
        return $this->order->paginate();
    }

    /**
     * @param $data
     * @param User $user
     * @return false|mixed
     */
    public function create($data, User $user): mixed
    {
        try {
            return DB::transaction(function () use ($data, $user) {
                $order = $this->order->create($data);
                $user->update(['balance' => $user->balance - $order->price]);
                return $order;
            });
        } catch (Exception $e) {
            return false;
        }
    }
}
