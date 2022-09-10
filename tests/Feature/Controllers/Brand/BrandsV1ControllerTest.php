<?php

namespace Tests\Feature\Controllers\Brand;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\Feature\BaseTestCase;

/**
 * Class BrandsV1ControllerTest
 * @package Tests\Feature\Brand
 * @coversDefaultClass \App\Http\Controllers\Api\Brand\BrandsV1Controller
 */
class BrandsV1ControllerTest extends BaseTestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @covers ::index
     * @covers ::__construct
     */
    function it_should_return_all_brands()
    {
        $user = $this->createUser(123456);
        $this->createCar(10);

        Sanctum::actingAs($user, ['*']);

        $response = $this->getJson('api/brands?version=1');

        $response->assertStatus(200);
    }

    /**
     * @test
     * @covers ::index
     */
    function it_should_not_return_cars_with_wrong_credentials()
    {
        $response = $this->getJson('api/brands?version=1');

        $response->assertStatus(401);
        $response->assertJsonPath('message', 'Unauthenticated.');
    }
}
