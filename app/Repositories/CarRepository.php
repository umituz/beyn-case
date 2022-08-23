<?php

namespace App\Repositories;

use App\Models\Car;

class CarRepository implements CarRepositoryInterface
{
    private Car $car;

    public function __construct(Car $car)
    {
        $this->car = $car;
    }
}
