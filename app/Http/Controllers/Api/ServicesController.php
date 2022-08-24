<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Service\ServiceCollection;
use App\Services\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ServicesController extends ApiController
{
    /**
     * @var Service
     */
    private Service $service;

    /**
     * @param Service $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return ServiceCollection
     */
    public function index(): ServiceCollection
    {
        return $this->service->getList();
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
