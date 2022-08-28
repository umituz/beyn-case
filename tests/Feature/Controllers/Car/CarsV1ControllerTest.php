<?php

namespace Tests\Feature\Controllers\Car;

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
    function it_should_return_all_cars()
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
     * @covers ::index
     */
    function it_should_not_return_cars_with_wrong_credentials()
    {
        $response = $this->getJson('api/v1/cars');

        $response->assertStatus(401);
        $response->assertJsonPath('message', 'Unauthenticated.');
    }
}
