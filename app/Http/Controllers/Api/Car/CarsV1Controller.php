<?php

namespace App\Http\Controllers\Api\Car;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Car\CarV1Collection;
use App\Http\Resources\Car\CarV1Resource;
use App\Repositories\CarRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
