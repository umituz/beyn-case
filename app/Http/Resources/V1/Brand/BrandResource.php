<?php

namespace App\Http\Resources\V1\Brand;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**
 * Class BrandResource
 * @package App\Http\Resources\Brand
 */
class BrandResource extends JsonResource
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
