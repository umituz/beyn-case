<?php

namespace App\Http\Resources\Service;

use App\Enums\VersionEnums;
use App\Http\Resources\BaseCollection;
use Illuminate\Http\Request;

/**
 * Class ServiceV1Collection
 * @package App\Http\Resources\Service
 */
class ServiceV1Collection extends BaseCollection
{
    public $collects = ServiceV1Resource::class;

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
            'user_balance' => $this->getUserBalance($request),
            'data' => $this->collection,
            'version' => VersionEnums::VERSION_1
        ];
    }
}
