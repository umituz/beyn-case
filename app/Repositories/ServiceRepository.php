<?php

namespace App\Repositories;

use App\Models\Service;
use App\Traits\NotifiableOnSlack;
use Exception;
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
     */
    public function getById($id): mixed
    {
        return $this->service->find($id);
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
}
