<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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

    /**
     * @param $filter
     * @return LengthAwarePaginator
     */
    public function getUserOrdersByFilter($filter): LengthAwarePaginator
    {
        $orders = auth()->user()->orders();

        if (isset($filter->service_id) && $filter->service_id) {
            $orders = $orders->where('service_id', $filter->service_id);
        }

        if (isset($filter->car_id) && $filter->car_id) {
            $orders = $orders->where('car_id', $filter->car_id);
        }

        if (isset($filter->status) && $filter->status) {
            $orders = $orders->where('status', $filter->status);
        }

        if (isset($filter->price) && $filter->price) {
            $orders = $orders->where('price', $filter->price);
        }

        return $orders->with(['car', 'service'])->paginate();
    }
}
