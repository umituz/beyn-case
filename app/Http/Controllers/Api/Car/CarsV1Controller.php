<?php

namespace App\Http\Controllers\Api\Car;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Car\CarCollection;
use App\Services\CarService;
use App\Services\NovassetsService;

class CarsV1Controller extends ApiController
{
    /**
     * @var CarService
     */
    private CarService $carService;
    #private NovassetsService $novassetsService;

    /**
     * @param CarService $carService
     */
    public function __construct(CarService $carService, NovassetsService $novassetsService)
    {
        $this->carService = $carService;
        #$this->novassetsService = $novassetsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return CarCollection
     */
    public function index()
    {
        return $this->carService->getList();
        #return $this->novassetsService->fetchAutomobiles();
    }
}
