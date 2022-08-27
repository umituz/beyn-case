<?php

namespace App\Repositories;

use App\Models\Car;

/**
 * Class CarRepositoryInterface
 * @package App\Repositories
 */
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
     * @param array $data
     * @return mixed
     */
    public function updateOrCreate(array $data): mixed;

    /**
     * @param int $id
     * @return mixed
     */
    public function getCarById(int $id): mixed;

}
