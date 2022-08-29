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
    public function rules(): array
    {
        return [
            'service_id' => ['required', 'integer', 'exists:services'],
            'car_id' => ['required', 'integer', 'exists:cars'],
            'price' => ['nullable', 'integer'],
        ];
    }
}
