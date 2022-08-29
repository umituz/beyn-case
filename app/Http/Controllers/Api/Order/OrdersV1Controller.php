<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\UserOrderFilterV1Request;
use App\Http\Requests\UserOrderV1Request;
use App\Http\Resources\Order\OrderV1Collection;
use App\Http\Resources\Order\OrderV1Resource;
use App\Repositories\ServiceRepositoryInterface;
use App\Repositories\CarRepositoryInterface;
use App\Repositories\OrderRepositoryInterface;
use Illuminate\Http\JsonResponse;

/**
 * Class OrdersV1Controller
 * @package App\Http\Controllers\Api\Order
 */
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
        CarRepositoryInterface     $carRepository,
        ServiceRepositoryInterface $serviceRepository,
        OrderRepositoryInterface   $orderRepository,
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
    public function store(UserOrderV1Request $request): JsonResponse
    {
        $user = $request->user();
        $service = $this->serviceRepository->getServiceById($request->service_id);

        if (!$service) {
            return $this->error(__('No service found!'));
        }

        $car = $this->carRepository->getCarById($request->car_id);

        if (!$car) {
            return $this->error(__('No car found!'));
        }

        $order = $this->orderRepository->create([
            'user_id' => $user->id,
            'service_id' => $request->service_id,
            'car_id' => $request->car_id,
            'status' => false,
            'price' => $service->price,
        ], $user);

        return $this->success(__('Success'), OrderV1Resource::make($order));
    }

    /**
     * @param UserOrderFilterV1Request $request
     * @return JsonResponse
     */
    public function filters(UserOrderFilterV1Request $request): JsonResponse
    {
        $orders = $this->orderRepository->getUserOrdersByFilter($request);

        return $this->success(__('Success'), OrderV1Resource::collection($orders));
    }
}
