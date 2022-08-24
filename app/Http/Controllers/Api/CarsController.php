<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Car\CarCollection;
use App\Services\CarService;
use App\Services\NovassetsService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CarsController extends Controller
{
    /**
     * @var CarService
     */
    private CarService $carService;
    private NovassetsService $novassetsService;

    /**
     * @param CarService $carService
     */
    public function __construct(CarService $carService, NovassetsService $novassetsService)
    {
        $this->carService = $carService;
        $this->novassetsService = $novassetsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return bool
     */
    public function index()
    {
        #return $this->carService->getList();
        return $this->novassetsService->fetchAutomobiles();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
