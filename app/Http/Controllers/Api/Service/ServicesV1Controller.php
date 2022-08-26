<?php

namespace App\Http\Controllers\Api\Service;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Service\ServiceCollection;
use App\Services\Service;

class ServicesV1Controller extends ApiController
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
}
