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
            'service_id' => ['nullable', 'integer', 'exists:services'],
            'car_id' => ['nullable', 'integer', 'exists:cars'],
            'status' => ['nullable']
        ];
    }
}
