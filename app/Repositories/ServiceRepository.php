<?php

namespace App\Repositories;

use App\Models\Service;
use Illuminate\Support\Facades\DB;

class ServiceRepository implements ServiceRepositoryInterface
{
    /**
     * @var Service
     */
    private Service $service;

    /**
     * @param Service $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * @return false|mixed
     */
    public function getAll(): mixed
    {
        return $this->service->paginate();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getServiceById(int $id): mixed
    {
        return $this->service->findOrFail($id);
    }
}
