<?php

namespace App\Http\Controllers\Api\Car;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\V1\Car\CarRequest;
use App\Http\Resources\Car\CarV1Collection;
use App\Http\Resources\Car\CarV1Resource;
use App\Repositories\CarRepositoryInterface;

/**
 * Class CarsV1Controller
 * @package App\Http\Controllers\Api\Car
 */
class CarsV1Controller extends ApiController
{
    private CarRepositoryInterface $carRepository;

    /**
     * @param CarRepositoryInterface $carRepository
     */
    public function __construct(CarRepositoryInterface $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return CarV1Collection
     */
    public function index(): CarV1Collection
    {
        $cars =  $this->carRepository->getAll();

        return new CarV1Collection($cars);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CarRequest $request
     * @return CarV1Resource
     */
    public function store(CarRequest $request): CarV1Resource
    {
        $car = $this->carRepository->create($request->validated());

        return new CarV1Resource($car);
    }

    /**
     * @param int $id
     * @return CarV1Resource
     */
    public function show(int $id): CarV1Resource
    {
        $car = $this->carRepository->getById($id);

        return new CarV1Resource($car);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CarRequest $request
     * @param int $id
     * @return CarV1Resource
     */
    public function update(CarRequest $request, $id)
    {
        $car = $this->carRepository->getById($id);
        $car->update($request->validated());

        return new CarV1Resource($car);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array
     */
    public function destroy($id): array
    {
       $this->carRepository->delete($id);

        return [
            'message' => __('Deleted')
        ];
    }
}
