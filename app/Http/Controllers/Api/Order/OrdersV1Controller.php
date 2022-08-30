<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\V1\Order\OrderFilterRequest;
use App\Http\Requests\V1\Order\OrderRequest;
use App\Http\Resources\V1\Order\OrderCollection;
use App\Http\Resources\V1\Order\OrderResource;
use App\Repositories\CarRepositoryInterface;
use App\Repositories\OrderRepositoryInterface;
use App\Repositories\ServiceRepositoryInterface;
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
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $orders = $this->orderRepository->getAll();

        return $this->success(__('Success'),  new OrderCollection($orders));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrderRequest $request
     * @return JsonResponse
     */
    public function store(OrderRequest $request): JsonResponse
    {
        $user = $request->user();
        $service = $this->serviceRepository->getById($request->service_id);
        $this->carRepository->getById($request->car_id);

        $order = $this->orderRepository->create([
            'user_id' => $user->id,
            'service_id' => $request->service_id,
            'car_id' => $request->car_id,
            'status' => false,
            'price' => $service->price,
        ], $user);

        return $this->success(__('Success'), OrderResource::make($order));
    }

    /**
     * @param OrderFilterRequest $request
     * @return JsonResponse
     */
    public function filters(OrderFilterRequest $request): JsonResponse
    {
        $orders = $this->orderRepository->getUserOrdersByFilter($request);

        return $this->success(__('Success'), OrderResource::collection($orders));
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $order = $this->orderRepository->getById($id);

        return $this->success(__('Success'), new OrderResource($order));
    }
}
