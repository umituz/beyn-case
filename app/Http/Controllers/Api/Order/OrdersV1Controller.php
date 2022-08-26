<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\UserOrderV1Request;
use App\Http\Resources\Order\OrderV1Collection;
use App\Http\Resources\Order\OrderV1Resource;
use App\Repositories\ServiceRepositoryInterface;
use App\Repositories\CarRepositoryInterface;
use App\Repositories\OrderRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class OrdersV1Controller extends ApiController
{
    private ServiceRepositoryInterface $serviceRepository;
    private CarRepositoryInterface $carRepository;
    private OrderRepositoryInterface $orderRepository;

    /**
     * @param CarRepositoryInterface $carRepository
     * @param ServiceRepositoryInterface $serviceRepository
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(
        CarRepositoryInterface $carRepository,
        ServiceRepositoryInterface $serviceRepository,
        OrderRepositoryInterface $orderRepository
    )
    {
        $this->serviceRepository = $serviceRepository;
        $this->carRepository = $carRepository;
        $this->orderRepository = $orderRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return OrderV1Collection
     */
    public function index(): OrderV1Collection
    {
        $orders = $this->orderRepository->getAll();

        return new OrderV1Collection($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserOrderV1Request $request
     * @return JsonResponse
     */
    public function store(UserOrderV1Request $request)
    {
        $user = Auth::user();
        $service = $this->serviceRepository->getServiceById($request->service_id);

        if (!$service) {
            return $this->error(__('No service found!'));
        }

        $car = $this->carRepository->getCarById($request->car_id);

        if (!$car) {
            return $this->error(__('No car found!'));
        }

        if ($user->balance < $service->price) {
            return $this->error(__('You have insufficient balance!'));
        }

        $order = $this->orderRepository->create([
            'user_id' => $user->id,
            'service_id' => $request->service_id,
            'car_id' => $request->car_id,
            'status' => false,
            'price' => $service->price,
        ], $user);

        if (!$order) {
            return $this->error(__('Failed to create order!'));
        }

        return $this->success(__('Success'), OrderV1Resource::make($order));
    }
}
