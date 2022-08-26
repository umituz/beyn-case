<?php

namespace App\Http\Controllers\Api\Service;

use JulioMotol\Lapiv\GatewayController;

class ServicesGatewayController extends GatewayController
{
    protected array $apiControllers = [
        ServicesV1Controller::class,
        ServicesV2Controller::class,
    ];
}
