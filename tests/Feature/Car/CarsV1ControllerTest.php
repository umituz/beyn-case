<?php

namespace Tests\Feature\Car;

use App\Models\Car;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\Feature\BaseTestCase;

/**
 * Class CarsV1ControllerTest
 * @package Tests\Feature\Car
 * @coversDefaultClass \App\Http\Controllers\Api\Car\CarsV1Controller
 */
class CarsV1ControllerTest extends BaseTestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @covers ::index
     * @covers ::__construct
     */
    public function it_should_return_all_cars()
    {
        $user = $this->createUser(123456);
        $this->createCar(10);

        Sanctum::actingAs($user, ['*']);

        $response = $this->getJson('api/v1/cars');
        $response->assertStatus(200);
        $response->assertJsonCount(10, 'data');
    }

    /**
     * @test
     */
    public function it_should_not_return_cars_with_wrong_credentials()
    {
        $response = $this->getJson('api/v1/cars');

        $response->assertStatus(401);
        $response->assertJsonPath('message', 'Unauthenticated.');
    }

    /**
     * @param int $count
     * @return Collection|HasFactory|Model|mixed
     */
    private function createCar(int $count = 1): mixed
    {
        return Car::factory()->count($count)->create();
    }
}
