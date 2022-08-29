<?php

namespace App\Http\Controllers\Api\Car;

use App\Http\Controllers\Api\ApiController;
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
     * @param int $id
     * @return mixed
     */
    public function show(int $id): mixed
    {
        $car = $this->carRepository->getCarById($id);

        return new CarV1Resource($car);
    }
}
