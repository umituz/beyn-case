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
    public function rules(): array
    {
        return [
            'service_id' => ['nullable', 'integer', 'exists:services'],
            'car_id' => ['nullable', 'integer', 'exists:cars'],
            'status' => ['nullable']
        ];
    }
}
