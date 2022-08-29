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
    const DATE_FORMAT = 'Y-m-d H:i:s';
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        self::withoutWrapping();

        return [
            'id' => $this->id,
            'price' => $this->price,
            'status' => $this->status,
            'created_at' => $this->created_at->format(self::DATE_FORMAT),
            'service' => $this->service,
            'car' => $this->car,
        ];
    }
}
