<?php

namespace App\Http\Controllers\Api\User;

use JulioMotol\Lapiv\GatewayController;

/**
 * Class UsersGatewayController
 * @package App\Http\Controllers\Api\User
 */
class UsersGatewayController extends GatewayController
{
    protected array $apiControllers = [
        UsersV1Controller::class
    ];
}
