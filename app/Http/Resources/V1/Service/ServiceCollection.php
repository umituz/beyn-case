<?php

namespace App\Http\Resources\V1\Service;

use App\Enums\VersionEnums;
use App\Http\Resources\BaseCollection;
use Illuminate\Http\Request;

/**
 * Class ServiceCollection
 * @package App\Http\Resources\V1\Service
 */
class ServiceCollection extends BaseCollection
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
            'user_balance' => $this->getUserBalance($request),
            'data' => $this->collection,
            'version' => VersionEnums::VERSION_1
        ];
    }
}
