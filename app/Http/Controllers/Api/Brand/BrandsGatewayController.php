<?php

namespace App\Http\Controllers\Api\Brand;

use JulioMotol\Lapiv\GatewayController;

/**
 * Class BrandsGatewayController
 * @package App\Http\Controllers\Api\Brand
 */
class BrandsGatewayController extends GatewayController
{
    protected array $apiControllers = [
        BrandsV1Controller::class
    ];
}
