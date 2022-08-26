<?php

namespace App\Http\Controllers\Api\Service;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Service\ServiceCollection;
use App\Services\Service;

class ServicesV2Controller extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index(): string
    {
        return __METHOD__;
    }
}
