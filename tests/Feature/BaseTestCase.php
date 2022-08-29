<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Car;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * Class BaseTestCase
 * @package Tests\Feature
 */
class BaseTestCase extends TestCase
{
    /**
     * @param $password
     * @return Collection|HasFactory|Model|mixed
     */
    public function createUser($password): mixed
    {
        return User::factory()->create(['password' => Hash::make($password)]);
    }

    /**
     * @param int $count
     * @return Collection|HasFactory|Model|mixed
     */
    public function createCar(int $count = 1): mixed
    {
        return Car::factory($count)->hasBrand()->times($count)->create();
    }

    /**
     * @param int $count
     * @return Collection|HasFactory|Model|mixed
     */
    public function createService(int $count = 1): mixed
    {
        return Service::factory()->count($count)->create(['price' => 50]);
    }
}
