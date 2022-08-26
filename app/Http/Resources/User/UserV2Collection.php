<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserV2Collection extends ResourceCollection
{
    public $collects = UserV1Resource::class;

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
            'data' => $this->resource,
            'version' => 2
        ];
    }
}
