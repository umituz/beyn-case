<?php

namespace App\Http\Controllers\Api\Service;

use JulioMotol\Lapiv\GatewayController;

/**
 * Class ServicesGatewayController
 * @package App\Http\Controllers\Api\Service
 */
class ServicesGatewayController extends GatewayController
{
    protected array $apiControllers = [
        ServicesV1Controller::class
    ];
}
