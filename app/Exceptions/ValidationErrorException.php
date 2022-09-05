<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class ValidationErrorException
 * @package App\Exceptions
 */
class ValidationErrorException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'errors' => [
                'code' => 422,
                'title' => __('Validation Error'),
                'detail' => __('Your request is malformed or missing fields.'),
                'meta' => json_decode($this->getMessage())
            ]
        ], 422);
    }
}
