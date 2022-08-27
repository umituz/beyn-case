<?php

namespace App\Http\Controllers\Api\Service;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Service\ServiceV1Collection;
use App\Repositories\ServiceRepositoryInterface;

/**
 * Class ServicesV1Controller
 * @package App\Http\Controllers\Api\Service
 */
class ServicesV1Controller extends ApiController
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
     * @return ServiceV1Collection
     */
    public function index(): ServiceV1Collection
    {
        $services = $this->serviceRepository->getAll();

        return new ServiceV1Collection($services);
    }
}
