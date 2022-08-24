<?php

namespace App\Repositories;

use App\Models\Car;

interface CarRepositoryInterface
{
    /**
     * @param Car $car
     */
    public function __construct(Car $car);

    /**
     * @return mixed
     */
    public function getAll(): mixed;

    /**
     * @param $data
     * @return mixed
     */
    public function updateOrCreate($data): mixed;
}
