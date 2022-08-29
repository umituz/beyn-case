<?php

namespace App\Http\Resources\V1\Service;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ServiceResource
 * @package App\Http\Resources\V1\Service
 */
class ServiceResource extends JsonResource
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
