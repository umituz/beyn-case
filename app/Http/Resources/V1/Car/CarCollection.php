<?php

namespace App\Http\Resources\V1\Car;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class CarCollection
 * @package App\Http\Resources\V1\Car
 */
class CarCollection extends ResourceCollection
{
    public $collects = CarResource::class;

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
