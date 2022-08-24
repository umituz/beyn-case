<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Order\OrderCollection;
use App\Repositories\ServiceRepositoryInterface;
use App\Repositories\CarRepositoryInterface;
use App\Repositories\V1\Interfaces\OrderRepositoryInterface;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $service = $this->serviceRepository->getServiceById($request->service_id);

        if (!$service) {
            return $this->error(__('No service found!'));
        }

        $car = $this->carRepository->getCarById($request->car_id);

        if (!$car) {
            return $this->error(__('No car found!'));
        }

        if ($this->user->balance ?? 1 < $service->price) {
            return $this->error(__('You have insufficient balance!'));
        }

        $order = $this->orderRepository->create([
            'user_id' => $this->user->id,
            'service_id' => $request->service_id,
            'car_id' => $request->car_id,
            'status' => false,
            'price' => $service->price,
        ], $this->user);
        if (!$order) {
            return $this->error(__('Failed to create order!'));
        }

        return $this->success(__('Success'), new OrderCollection($order));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
