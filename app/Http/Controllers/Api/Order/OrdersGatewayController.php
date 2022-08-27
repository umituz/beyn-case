<?php

namespace App\Http\Controllers\Api\Order;

use JulioMotol\Lapiv\GatewayController;

class OrdersGatewayController extends GatewayController
{
    protected array $apiControllers = [
        OrdersV1Controller::class
    ];
}
