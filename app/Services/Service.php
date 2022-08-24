<?php

namespace App\Services;

use App\Http\Resources\Service\ServiceCollection;
use App\Repositories\ServiceRepositoryInterface;

class Service
{
    /**
     * @var ServiceRepositoryInterface
     */
    private ServiceRepositoryInterface $serviceRepository;

    /**
     * @param ServiceRepositoryInterface $serviceRepository
     */
    public function __construct(ServiceRepositoryInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * @return ServiceCollection
     */
    public function getList(): ServiceCollection
    {
        $services = $this->serviceRepository->getAll();

        return new ServiceCollection($services);
    }
}
