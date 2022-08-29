<?php

namespace App\Http\Controllers\Api\Service;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\V1\Service\ServiceCollection;
use App\Http\Resources\V1\Service\ServiceResource;
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
     * @return ServiceCollection
     */
    public function index(): ServiceCollection
    {
        $services = $this->serviceRepository->getAll();

        return new ServiceCollection($services);
    }

    /**
     * @param int $id
     * @return ServiceResource
     */
    public function show(int $id): ServiceResource
    {
        $service = $this->serviceRepository->getById($id);

        return new ServiceResource($service);
    }
}
