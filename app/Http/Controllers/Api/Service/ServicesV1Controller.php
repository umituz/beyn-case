<?php

namespace App\Http\Controllers\Api\Service;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\V1\Service\ServiceRequest;
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
     * Store a newly created resource in storage.
     *
     * @param ServiceRequest $request
     * @return ServiceResource
     */
    public function store(ServiceRequest $request): ServiceResource
    {
        $brand = $this->serviceRepository->create($request->validated());

        return new ServiceResource($brand);
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

    /**
     * Update the specified resource in storage.
     *
     * @param ServiceRequest $request
     * @param int $id
     * @return ServiceResource
     */
    public function update(ServiceRequest $request, $id): ServiceResource
    {
        $brand = $this->serviceRepository->update($id, $request->validated());

        return new ServiceResource($brand);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array
     */
    public function destroy($id): array
    {
        $this->serviceRepository->delete($id);

        return [
            'message' => __('Deleted')
        ];
    }
}
