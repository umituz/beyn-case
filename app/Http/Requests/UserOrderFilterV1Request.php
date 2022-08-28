<?php

namespace App\Http\Requests;

/**
 * Class UserOrderFilterV1Request
 * @package App\Http\Request
 */
class UserOrderFilterV1Request extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'service_id' => 'nullable|int',
            'car_id' => 'nullable|int',
            'status' => 'nullable',
            'price' => 'nullable|int',
        ];
    }
}
