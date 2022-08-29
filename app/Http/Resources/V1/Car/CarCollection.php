<?php

namespace App\Http\Resources\V1\Car;

use App\Enums\VersionEnums;
use App\Http\Resources\BaseCollection;
use Illuminate\Http\Request;

/**
 * Class CarCollection
 * @package App\Http\Resources\V1\Car
 */
class CarCollection extends BaseCollection
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
            'user_balance' => $this->getUserBalance($request),
            'data' => $this->collection,
            'version' => VersionEnums::VERSION_1,
        ];
    }
}
