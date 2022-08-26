<?php

namespace App\Http\Resources\Order;

use App\Enums\VersionEnums;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderV2Collection extends ResourceCollection
{
    public $collects = OrderV2Resource::class;

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
            'version' => VersionEnums::VERSION_2
        ];
    }
}
