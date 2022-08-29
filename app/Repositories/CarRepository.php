<?php

namespace App\Repositories;

use App\Models\Car;
use App\Traits\NotifiableOnSlack;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class CarRepository
 * @package App\Repositories
 */
class CarRepository implements CarRepositoryInterface
{
    use NotifiableOnSlack;

    /**
     * @var Car
     */
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
     */
    public function getById(int $id): mixed
    {
        return $this->car->find($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed
    {
        return $this->car->create($data);
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return $this->car->destroy($id);
    }
}
