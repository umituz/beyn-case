<?php

namespace App\Repositories;

use App\Models\Car;
use Exception;
use Illuminate\Support\Facades\DB;

class CarRepository implements CarRepositoryInterface
{
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
            return false;
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getCarById(int $id): mixed
    {
        return $this->car->findOrFail($id);
    }
}
