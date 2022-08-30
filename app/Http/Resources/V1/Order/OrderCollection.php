<?php

namespace App\Http\Resources\V1\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class OrderCollection
 * @package App\Http\Resources\Order
 */
class OrderCollection extends ResourceCollection
{
    public $collects = OrderResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
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
