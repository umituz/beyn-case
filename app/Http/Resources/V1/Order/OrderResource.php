<?php

namespace App\Http\Resources\V1\Order;

use App\Http\Resources\V1\Car\CarResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class OrderResource
 * @package App\Http\Resources\V1\Order
 */
class OrderResource extends JsonResource
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
            'updated_at' => $this->updated_at->format(self::DATE_FORMAT),
            'service' => $this->service,
            'car' => new CarResource($this->car),
        ];
    }
}
