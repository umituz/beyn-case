<?php

namespace App\Http\Controllers\Api\Car;

use JulioMotol\Lapiv\GatewayController;

/**
 * Class CarsGatewayController
 * @package App\Http\Controllers\Api\Car
 */
class CarsGatewayController extends GatewayController
{
    protected array $apiControllers = [
        CarsV1Controller::class
    ];
}
