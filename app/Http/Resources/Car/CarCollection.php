<?php

namespace App\Http\Resources\Car;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class CarCollection extends ResourceCollection
{
    public $collects = CarResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'total' => $this->resource->count(),
            'data' => $this->resource
        ];
    }
}
