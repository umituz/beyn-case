<?php

namespace Tests\Feature\Controllers\Order;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\Feature\BaseTestCase;

/**
 * Class OrdersV1ControllerTest
 * @package Tests\Feature\Service
 * @coversDefaultClass \App\Http\Controllers\Api\Order\OrdersV1Controller
 */
class OrdersV1ControllerTest extends BaseTestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @covers ::index
     * @covers ::__construct
     */
    function it_should_return_all_orders()
    {
        $user = $this->createUser(123456);
        Sanctum::actingAs($user, ['*']);

        $response = $this->getJson('api/orders?version=1');

        $response->assertStatus(200);
    }

    /**
     * @test
     * @covers ::index
     */
    function it_should_not_return_orders_with_wrong_credentials()
    {
        $response = $this->getJson('api/orders?version=1');

        $response->assertStatus(401);
        $response->assertJsonPath('message', 'Unauthenticated.');
    }

    /**
     * @test
     * @covers ::store
     */
    function it_should_create_a_order()
    {
        $user = $this->createUser(123456);
        $this->updateUserBalance($user);
        Sanctum::actingAs($user, ['*']);
        $service = $this->createService();
        $car = $this->createCar();
        $data = [
            'service_id' => $service->first()->id,
            'car_id' => $car->first()->id
        ];

        $response = $this->postJson('api/orders?version=1', $data);

        $response->assertStatus(200);

        $response->assertJsonPath('message', 'Success');

        $response->assertJsonPath('data.service.id', $service->first()->id);

        $response->assertJsonPath('data.car.id', $car->first()->id);
        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'service_id' => $service->first()->id,
            'car_id' => $car->first()->id
        ]);
        $this->assertDatabaseCount('orders', 1);
    }

    /**
     * @test
     * @covers ::filters
     */
    function it_should_filter_orders()
    {
        $user = $this->createUser(123456);
        $this->updateUserBalance($user);
        Sanctum::actingAs($user, ['*']);
        $service = $this->createService();
        $car = $this->createCar();

        $data = [
            'service_id' => $service->first()->id,
            'car_id' => $car->first()->id
        ];

        $response = $this->postJson('api/orders?version=1', $data);
        $response->assertStatus(200);

        $response->assertJsonPath('message', 'Success');

        $response->assertJsonPath('data.service.id', $service->first()->id);

        $response->assertJsonPath('data.car.id', $car->first()->id);

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'service_id' => $service->first()->id,
            'car_id' => $car->first()->id
        ]);

        $this->assertDatabaseCount('orders', 1);
    }

    /**
     * @param $user
     * @param $balance
     * @return mixed
     */
    private function updateUserBalance($user, $balance = 100)
    {
        return $user->update(['balance' => $balance]);
    }
}
