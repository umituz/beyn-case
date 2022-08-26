<?php

namespace App\Http\Controllers\Api\Service;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Service\ServiceV2Collection;
use App\Repositories\ServiceRepositoryInterface;

class ServicesV2Controller extends ApiController
{
    private ServiceRepositoryInterface $serviceRepository;

    /**
     * @param ServiceRepositoryInterface $serviceRepository
     */
    public function __construct(ServiceRepositoryInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return ServiceV2Collection
     */
    public function index(): ServiceV2Collection
    {
        $services = $this->serviceRepository->getAll();

        return new ServiceV2Collection($services);
    }
}
