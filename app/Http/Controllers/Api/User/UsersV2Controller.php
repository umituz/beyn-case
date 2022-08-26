<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\UserBalanceRequest;

class UsersV2Controller extends ApiController
{
    /**
     * @return string
     */
    public function index(): string
    {
        return __METHOD__;
    }

    public function addBalance(UserBalanceRequest $request): string
    {
        return __METHOD__;
    }
}
