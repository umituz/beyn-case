<?php

namespace App\Repositories;

use App\Models\Service;

/**
 * Class ServiceRepositoryInterface
 * @package App\Repositories
 */
interface ServiceRepositoryInterface
{
    /**
     * @param Service $service
     */
    public function __construct(Service $service);

    /**
     * @return mixed
     */
    public function getAll(): mixed;

    /**
     * @param  $id
     * @return mixed
     */
    public function getServiceById( $id): mixed;
}
