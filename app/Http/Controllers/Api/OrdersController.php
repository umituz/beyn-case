<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserOrderRequest;
use App\Http\Resources\Order\OrderCollection;
use App\Http\Resources\Order\OrderResource;
use App\Repositories\ServiceRepositoryInterface;
use App\Repositories\CarRepositoryInterface;
use App\Repositories\OrderRepositoryInterface;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class OrdersController extends ApiController
{
    private OrderService $orderService;
    private ServiceRepositoryInterface $serviceRepository;
    private CarRepositoryInterface $carRepository;
    private OrderRepositoryInterface $orderRepository;

    /**
     * @param OrderService $orderService
     */
    public function __construct(
        OrderService $orderService,
        CarRepositoryInterface $carRepository,
        ServiceRepositoryInterface $serviceRepository,
        OrderRepositoryInterface $orderRepository
    )
    {
        $this->orderService = $orderService;
        $this->serviceRepository = $serviceRepository;
        $this->carRepository = $carRepository;
        $this->orderRepository = $orderRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return OrderCollection
     */
    public function index(): OrderCollection
    {
        return $this->orderService->getList();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserOrderRequest $request
     * @return JsonResponse
     */
    public function store(UserOrderRequest $request)
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

        return $this->success(__('Success'), OrderResource::make($order));
    }
}
