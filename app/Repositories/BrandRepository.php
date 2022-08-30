<?php

namespace App\Repositories;

use App\Exceptions\RecordNotFoundException;
use App\Models\Brand;
use App\Traits\NotifiableOnSlack;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

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
        try {
            return DB::transaction(function () use ($data) {
                return $this->brand->create($data);
            });
        } catch (Exception $e) {
            $this->toSlack(config('slack.channels.db_issues'), $e->getMessage());

            return false;
        }
    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data): mixed
    {
        try {
            return DB::transaction(function () use ($id, $data) {
                $brand = $this->getById($id);
                $brand->update($data);

                return $brand;
            });
        } catch (Exception $e) {
            $this->toSlack(config('slack.channels.db_issues'), $e->getMessage());

            return false;
        }
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        try {
            return DB::transaction(function () use ($id) {
                return $this->brand->destroy($id);
            });
        } catch (Exception $e) {
            $this->toSlack(config('slack.channels.db_issues'), $e->getMessage());

            return false;
        }
    }

    /**
     * @param array $data
     * @return false|mixed
     */
    public function updateOrCreate(array $data): mixed
    {
        try {
            return DB::transaction(function () use ($data) {
                return $this->brand->updateOrCreate($data);
            });
        } catch (Exception $e) {
            $this->toSlack(config('slack.channels.db_issues'), $e->getMessage());

            return false;
        }
    }
}
