<?php

namespace App\Http\Controllers\Api\Brand;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Brand\BrandRequest;
use App\Http\Resources\V1\Brand\BrandCollection;
use App\Http\Resources\V1\Brand\BrandResource;
use App\Repositories\BrandRepositoryInterface;
use Illuminate\Http\Request;

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
        $car = $this->brandRepository->create($request->validated());

        return new BrandResource($car);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return BrandResource
     */
    public function show($id): BrandResource
    {
        $car = $this->brandRepository->getById($id);

        return new BrandResource($car);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
