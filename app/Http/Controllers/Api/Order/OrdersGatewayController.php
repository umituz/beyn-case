<?php

namespace App\Http\Controllers\Api\Order;

use JulioMotol\Lapiv\GatewayController;

/**
 * Class OrdersGatewayController
 * @package App\Http\Controllers\Api\Order
 */
class OrdersGatewayController extends GatewayController
{
    protected array $apiControllers = [
        OrdersV1Controller::class
    ];
}
