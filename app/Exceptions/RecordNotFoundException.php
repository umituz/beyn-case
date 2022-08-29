<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class RecordNotFoundException
 * @package App\Exceptions
 */
class RecordNotFoundException extends Exception
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
                'code' => 404,
                'title' => __('Record Not Found'),
                'detail' => __('Unable to locate the record with the given information')
            ]
        ], 404);
    }
}
