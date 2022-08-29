<?php

namespace App\Http\Controllers\Api\Auth;

use JulioMotol\Lapiv\GatewayController;

/**
 * Class AuthGatewayController
 * @package App\Http\Controllers\Api\Auth
 */
class AuthGatewayController extends GatewayController
{
    protected array $apiControllers = [
        AuthV1Controller::class
    ];
}
