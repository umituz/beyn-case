<?php

namespace App\Services;

use App\Http\Resources\Order\OrderCollection;
use App\Repositories\OrderRepositoryInterface;

class OrderService
{
    /**
     * @var OrderRepositoryInterface
     */
    private OrderRepositoryInterface $orderRepository;

    /**
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getList()
    {
        $orders = $this->orderRepository->getAll();

        return new OrderCollection($orders);
    }
}
