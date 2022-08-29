<?php

namespace App\Http\Requests\V1\Brand;

use App\Http\Requests\Request;

/**
 * Class BrandRequest
 * @package App\Http\Requests
 */
class BrandRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:191'],
            'model' => ['required', 'string', 'max:191'],
            'url' => ['required', 'string', 'url', 'max:191'],
            'year' => ['required', 'string', 'max:191'],
        ];
    }
}
