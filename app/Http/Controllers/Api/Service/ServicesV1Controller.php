<?php

namespace App\Http\Controllers\Api\Service;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\V1\Service\ServiceRequest;
use App\Http\Resources\V1\Service\ServiceCollection;
use App\Http\Resources\V1\Service\ServiceResource;
use App\Repositories\ServiceRepositoryInterface;
use Illuminate\Http\JsonResponse;

/**
 * Class ServicesV1Controller
 * @package App\Http\Controllers\Api\Service
 */
class ServicesV1Controller extends ApiController
{
    /**
     * @param ServiceRepositoryInterface $serviceRepository
     */
    public function __construct(protected ServiceRepositoryInterface $serviceRepository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $services = $this->serviceRepository->getAll();

        return $this->success(__('Success'),  new ServiceCollection($services));
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
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $service = $this->serviceRepository->getById($id);

        return $this->success(__('Success'),  new ServiceResource($service));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ServiceRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(ServiceRequest $request, $id): JsonResponse
    {
        $brand = $this->serviceRepository->update($id, $request->validated());

        return $this->success(__('Success'),  new ServiceResource($brand));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $this->serviceRepository->delete($id);

        return $this->success(__('Success'), [
            'message' => 'Deleted'
        ]);
    }
}
