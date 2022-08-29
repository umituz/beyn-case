<?php

namespace App\Repositories;

use App\Exceptions\RecordNotFoundException;
use App\Models\Car;
use App\Traits\NotifiableOnSlack;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

/**
 * Class CarRepository
 * @package App\Repositories
 */
class CarRepository implements CarRepositoryInterface
{
    use NotifiableOnSlack;

    private Car $car;

    /**
     * @param Car $car
     */
    public function __construct(Car $car)
    {
        $this->car = $car;
    }

    /**
     * @return false|mixed
     */
    public function getAll(): mixed
    {
        return $this->car->paginate();
    }

    /**
     * @param array $data
     * @return false|mixed
     */
    public function updateOrCreate(array $data): mixed
    {
        try {
            return DB::transaction(function () use ($data) {
                return $this->car->updateOrCreate($data);
            });
        } catch (Exception $e) {
            $this->toSlack(config('slack.channels.db_issues'), $e->getMessage());

            return false;
        }
    }

    /**
     * @param int $id
     * @return mixed
     * @throws RecordNotFoundException
     */
    public function getById(int $id): mixed
    {
        try {
            return $this->car->findOrFail($id);
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
                return $this->car->create($data);
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
                return $this->car->destroy($id);
            });
        } catch (Exception $e) {
            $this->toSlack(config('slack.channels.db_issues'), $e->getMessage());

            return false;
        }
    }
}
