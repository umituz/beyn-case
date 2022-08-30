<?php

namespace App\Http\Resources\V1\Service;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class ServiceCollection
 * @package App\Http\Resources\V1\Service
 */
class ServiceCollection extends ResourceCollection
{
    public $collects = ServiceResource::class;

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
