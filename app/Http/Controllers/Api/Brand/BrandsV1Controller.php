<?php

namespace App\Http\Controllers\Api\Brand;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\V1\Brand\BrandRequest;
use App\Http\Resources\V1\Brand\BrandCollection;
use App\Http\Resources\V1\Brand\BrandResource;
use App\Repositories\BrandRepositoryInterface;
use Illuminate\Http\JsonResponse;

/**
 * Class BrandsV1Controller
 * @package App\Http\Controllers\Api\Brand
 */
class BrandsV1Controller extends ApiController
{
    public function __construct(protected BrandRepositoryInterface $brandRepository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $brands = $this->brandRepository->getAll();

        return $this->success(__('Success'), new BrandCollection($brands));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BrandRequest $request
     * @return JsonResponse
     */
    public function store(BrandRequest $request): JsonResponse
    {
        $brand = $this->brandRepository->create($request->validated());

        return $this->success(__('Success'), new BrandResource($brand));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $brand = $this->brandRepository->getById($id);

        return $this->success(__('Success'), new BrandResource($brand));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BrandRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(BrandRequest $request, $id): JsonResponse
    {
        $brand = $this->brandRepository->update($id, $request->validated());

        return $this->success(__('Success'), new BrandResource($brand));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $this->brandRepository->delete($id);

        return $this->success(__('Success'), [
            'message' => 'Deleted'
        ]);
    }
}
