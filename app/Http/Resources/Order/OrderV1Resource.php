<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class OrderV1Resource
 * @package App\Http\Resources\Order
 */
class OrderV1Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        self::withoutWrapping();

        return parent::toArray($request);
    }
}
