<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Traits\NotifiableOnSlack;

/**
 * Class BrandRepository
 * @package App\Repositories
 */
class BrandRepository implements BrandRepositoryInterface
{
    use NotifiableOnSlack;

    private Brand $brand;

    /**
     * @param Brand $brand
     */
    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return false|mixed
     */
    public function getAll(): mixed
    {
        return $this->brand->paginate();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id): mixed
    {
        return $this->brand->find($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed
    {
        return $this->brand->create($data);
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return $this->brand->destroy($id);
    }
}
