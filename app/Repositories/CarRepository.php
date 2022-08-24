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
        try {
            return DB::transaction(function () {
                return Car::paginate();
            });
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * @param $data
     * @return false|mixed
     */
    public function updateOrCreate($data): mixed
    {
        try {
            return DB::transaction(function () use ($data) {
                return Car::updateOrCreate($data);
            });
        } catch (\Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }
}
