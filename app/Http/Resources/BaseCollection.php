<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class BaseCollection
 * @package App\Http\Resources
 */
class BaseCollection extends ResourceCollection
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function getUserBalance(Request $request)
    {
        return $request->user()->balance;
    }
}
