<?php

namespace App\Http\Controllers\Api\Car;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\V1\Car\CarRequest;
use App\Http\Resources\V1\Car\CarCollection;
use App\Http\Resources\V1\Car\CarResource;
use App\Repositories\CarRepositoryInterface;
use Illuminate\Http\JsonResponse;

/**
 * Class CarsV1Controller
 * @package App\Http\Controllers\Api\Car
 */
class CarsV1Controller extends ApiController
{
    /**
     * @param CarRepositoryInterface $carRepository
     */
    public function __construct(protected CarRepositoryInterface $carRepository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $cars = $this->carRepository->getAll();

        return $this->success(message: __('Success'), data: new CarCollection($cars));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CarRequest $request
     * @return JsonResponse
     */
    public function store(CarRequest $request): JsonResponse
    {
        $car = $this->carRepository->create($request->validated());

        return $this->success(message: __('Success'), data: new CarResource($car));
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $car = $this->carRepository->getById($id);

        return $this->success(message: __('Success'), data: new CarResource($car));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CarRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(CarRequest $request, int $id): JsonResponse
    {
        $car = $this->carRepository->update($id, $request->validated());

        return $this->success(message: __('Success'), data: new CarResource($car));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->carRepository->delete($id);

        return $this->success(
            message: __('Success'),
            data: [
                'message' => 'Deleted'
            ]
        );
    }
}
