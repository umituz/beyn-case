<?php

namespace App\Repositories;

use App\Models\Service;

class ServiceRepository implements ServiceRepositoryInterface
{
    private Service $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
