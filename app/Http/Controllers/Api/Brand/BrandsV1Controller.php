<?php

namespace App\Http\Controllers\Api\Brand;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Brand\BrandRequest;
use App\Http\Resources\V1\Brand\BrandCollection;
use App\Http\Resources\V1\Brand\BrandResource;
use App\Repositories\BrandRepositoryInterface;

/**
 * Class BrandsV1Controller
 * @package App\Http\Controllers\Api\Brand
 */
class BrandsV1Controller extends Controller
{
    private BrandRepositoryInterface $brandRepository;

    /**
     * @param BrandRepositoryInterface $brandRepository
     */
    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return BrandCollection
     */
    public function index(): BrandCollection
    {
        $brands = $this->brandRepository->getAll();

        return new BrandCollection($brands);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BrandRequest $request
     * @return BrandResource
     */
    public function store(BrandRequest $request): BrandResource
    {
        $brand = $this->brandRepository->create($request->validated());

        return new BrandResource($brand);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return BrandResource
     */
    public function show($id): BrandResource
    {
        $brand = $this->brandRepository->getById($id);

        return new BrandResource($brand);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BrandRequest $request
     * @param int $id
     * @return BrandResource
     */
    public function update(BrandRequest $request, $id): BrandResource
    {
        $brand = $this->brandRepository->getById($id);
        $brand->update($request->validated());

        return new BrandResource($brand);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array
     */
    public function destroy($id): array
    {
        $this->brandRepository->delete($id);

        return [
            'message' => __('Deleted')
        ];
    }
}
