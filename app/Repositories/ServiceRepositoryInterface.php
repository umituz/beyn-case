<?php

namespace App\Repositories;

use App\Models\Service;

/**
 * Interface ServiceRepositoryInterface
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
     * @param $id
     * @return mixed
     */
    public function getById($id): mixed;

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed;

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data): mixed;

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id): int;
}
