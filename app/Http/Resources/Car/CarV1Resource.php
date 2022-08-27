<?php

namespace App\Http\Resources\Car;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**
 * Class CarV1Resource
 * @package App\Http\Resources\Car
 */
class CarV1Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        self::withoutWrapping();

        return parent::toArray($request);
    }
}
