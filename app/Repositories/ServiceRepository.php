<?php

namespace App\Repositories;

use App\Models\Service;
use Illuminate\Support\Facades\DB;

/**
 * Class ServiceRepository
 * @package App\Repositories
 */
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
     * @param  $id
     * @return mixed
     */
    public function getServiceById($id): mixed
    {
        return $this->service->find($id);
    }
}
