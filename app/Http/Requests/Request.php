<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class Request
 * @package App\Http\Requests
 */
abstract class Request extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @param  string  $key
     * @return string
     */
    public function getBase64Decoded(string $key): string
    {
        return base64_decode($this->get($key));
    }
}
