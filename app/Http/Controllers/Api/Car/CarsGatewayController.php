<?php

namespace App\Http\Controllers\Api\Car;

use JulioMotol\Lapiv\GatewayController;

class CarsGatewayController extends GatewayController
{
    protected array $apiControllers = [
        CarsV1Controller::class,
        CarsV2Controller::class,
    ];
}
