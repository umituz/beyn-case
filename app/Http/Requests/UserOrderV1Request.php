<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UserOrderV1Request
 * @package App\Http\Request
 */
class UserOrderV1Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

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
