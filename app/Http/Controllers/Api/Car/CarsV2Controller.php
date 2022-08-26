<?php

namespace App\Http\Controllers\Api\Car;

use App\Http\Controllers\Controller;
use App\Http\Resources\Car\CarV2Collection;
use App\Repositories\CarRepositoryInterface;

class CarsV2Controller extends Controller
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
     * @return CarV2Collection
     */
    public function index(): CarV2Collection
    {
        $cars = $this->carRepository->getAll();

        return new CarV2Collection($cars);
    }
}
