<?php

namespace App\Repositories;

use App\Exceptions\RecordNotFoundException;
use App\Models\Brand;
use App\Traits\NotifiableOnSlack;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
     * @throws RecordNotFoundException
     */
    public function getById(int $id): mixed
    {
        try {
            return $this->brand->findOrFail($id);
        } catch (ModelNotFoundException $exception) {

            $this->toSlack('slack.channels.db_issues', __('Record Not Found: ' . $exception->getMessage()));

            throw new RecordNotFoundException();
        }
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
