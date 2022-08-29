<?php

namespace App\Http\Resources\V1\Car;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**
 * Class CarResource
 * @package App\Http\Resources\V1\Car
 */
class CarResource extends JsonResource
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
