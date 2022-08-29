<?php

namespace App\Repositories;

use App\Models\Brand;

/**
 * Interface BrandRepositoryInterface
 * @package App\Repositories
 */
interface BrandRepositoryInterface
{
    /**
     * @param Brand $brand
     */
    public function __construct(Brand $brand);

    /**
     * @return mixed
     */
    public function getAll(): mixed;

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id): mixed;

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

    /**
     * @param array $data
     * @return mixed
     */
    public function updateOrCreate(array $data): mixed;
}
