<?php

namespace App\Services;

use App\Http\Resources\Car\CarCollection;
use App\Repositories\CarRepositoryInterface;

class CarService
{
    /**
     * @var CarRepositoryInterface
     */
    private CarRepositoryInterface $carRepository;

    /**
     * @param CarRepositoryInterface $carRepository
     */
    public function __construct(CarRepositoryInterface $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    /**
     * @return CarCollection
     */
    public function getList(): CarCollection
    {
        $cars = $this->carRepository->getAll();

        return new CarCollection($cars);
    }
}
