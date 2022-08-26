<?php

namespace App\Http\Controllers\Api\User;

use JulioMotol\Lapiv\GatewayController;

class UsersGatewayController extends GatewayController
{
    protected array $apiControllers = [
        UsersV1Controller::class,
        UsersV2Controller::class,
    ];
}
