<?php

namespace App\Http\Requests\V1\Order;

use App\Http\Requests\Request;

/**
 * Class OrderFilterRequest
 * @package App\Http\Requests\V1\Order
 */
class OrderFilterRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'service_id' => ['nullable', 'integer'],
            'car_id' => ['nullable', 'integer'],
            'status' => ['nullable']
        ];
    }
}
