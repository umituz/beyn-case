<?php

namespace App\Http\Resources\V1\Brand;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class BrandCollection
 * @package App\Http\Resources\Brand
 */
class BrandCollection extends ResourceCollection
{
    public $collects = BrandResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'total' => $this->resource->count(),
            'data' => $this->collection,
        ];
    }
}
