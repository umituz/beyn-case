<?php

namespace App\Http\Requests;

/**
 * Class UserOrderV1Request
 * @package App\Http\Request
 */
class UserOrderV1Request extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'service_id' => ['required', 'integer'],
            'car_id' => ['required', 'integer'],
            'price' => ['nullable', 'integer'],
        ];
    }
}
