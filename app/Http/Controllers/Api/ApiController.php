<?php

namespace App\Http\Controllers\Api;

use App\Enums\VersionEnums;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ApiController
 * @package App\Http\Controllers\Api
 */
class ApiController extends Controller
{
    /**
     * @param $message
     * @param $data
     * @return JsonResponse
     */
    public function success($message, $data): JsonResponse
    {
        if (is_null($message)) {
            $message = __('Successful');
        }

        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => $message,
            'user_balance' => UserService::getBalance(),
            'version' => VersionEnums::VERSION_1,
            'data' => $data,

        ], Response::HTTP_OK);
    }

    /**
     * @param $message
     * @return JsonResponse
     */
    public function error($message = null): JsonResponse
    {
        if (is_null($message)) {
            $message = __('Error');
        }

        return response()->json([
            'code' => Response::HTTP_FORBIDDEN,
            'message' => $message
        ], Response::HTTP_FORBIDDEN);
    }
}
