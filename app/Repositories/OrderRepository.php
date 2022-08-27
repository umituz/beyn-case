<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\User;
use App\Traits\NotifiableOnSlack;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class OrderRepository
 * @package App\Repositories
 */
class OrderRepository implements OrderRepositoryInterface
{
    use NotifiableOnSlack;

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
            $this->toSlack(config('slack.channels.db_issues'), $e->getMessage());

            return false;
        }
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getUserOrdersByFilter($request): mixed
    {
        $orders = auth()->user()->orders();

        $orders = $orders->when($request->service_id, function ($query) use ($request) {
            $query->where('service_id', $request->service_id);
        });

        $orders = $orders->when($request->car_id, function ($query) use ($request) {
            $query->where('car_id', $request->car_id);
        });

        $orders = $orders->when($request->status, function ($query) use ($request) {
            $query->where('status', $request->status);
        });

        return $orders->get();
    }
}
