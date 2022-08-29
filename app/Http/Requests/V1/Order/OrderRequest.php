<?php

namespace App\Http\Requests\V1\Order;

use App\Http\Requests\Request;

/**
 * Class OrderRequest
 * @package App\Http\Requests\V1\Order
 */
class OrderRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'service_id' => ['required', 'integer'],
            'car_id' => ['required', 'integer'],
            'price' => ['nullable', 'integer'],
        ];
    }
}
