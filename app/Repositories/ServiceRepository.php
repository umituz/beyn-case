<?php

namespace App\Repositories;

use App\Exceptions\RecordNotFoundException;
use App\Models\Service;
use App\Traits\NotifiableOnSlack;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

/**
 * Class ServiceRepository
 * @package App\Repositories
 */
class ServiceRepository implements ServiceRepositoryInterface
{
    use NotifiableOnSlack;

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
     * @throws RecordNotFoundException
     */
    public function getById($id): mixed
    {
        try {
            return $this->service->findOrFail($id);
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
                return $this->service->create($data);
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
                $service = $this->getById($id);
                $service->update($data);

                return $service;
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
                return $this->service->destroy($id);
            });
        } catch (Exception $e) {
            $this->toSlack(config('slack.channels.db_issues'), $e->getMessage());

            return false;
        }
    }
}
