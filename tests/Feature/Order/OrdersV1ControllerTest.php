<?php

namespace Tests\Feature\Order;

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
        $this->createOrder(10);
        Sanctum::actingAs($user, ['*']);

        $response = $this->getJson('api/v1/orders');

        $response->assertStatus(200);
        $response->assertJsonCount(10, 'data');
    }

    /**
     * @test
     * @covers ::index
     */
    function it_should_not_return_orders_with_wrong_credentials()
    {
        $response = $this->getJson('api/v1/orders');

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

        $response = $this->postJson('api/v1/orders', $data);

        $response->assertStatus(200);
        $response->assertJsonPath('message', 'Success');
        $response->assertJsonPath('data.service_id', $service[0]->id);
        $response->assertJsonPath('data.car_id', $car[0]->id);
        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'service_id' => $service[0]->id,
            'car_id' => $car[0]->id
        ]);
        $this->assertDatabaseCount('orders', 1);
    }

    /**
     * @test
     * @covers ::store
     */
    public function it_should_not_create_order_with_wrong_service()
    {
        $user = $this->createUser(123456);
        $this->updateUserBalance($user);
        Sanctum::actingAs($user, ['*']);
        $this->createService();
        $car = $this->createCar();
        $data = [
            'service_id' => random_int(99,9999),
            'car_id' => $car->first()->id
        ];

        $response = $this->postJson('api/v1/orders', $data);

        $response->assertStatus(403);
        $response->assertJsonPath('message', 'No service found!');
        $this->assertDatabaseCount('orders', 0);
    }

    /**
     * @test
     * @covers ::store
     */
    public function it_should_not_create_order_with_wrong_car()
    {
        $user = $this->createUser(123456);
        $this->updateUserBalance($user);
        Sanctum::actingAs($user, ['*']);

        $service = $this->createService();
        $this->createCar();

        $data = [
            'service_id' => $service->first()->id,
            'car_id' => 2222
        ];
        $response = $this->postJson('api/v1/orders', $data);

        $response->assertStatus(403);
        $response->assertJsonPath('message', 'No car found!');
        $this->assertDatabaseCount('orders', 0);
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

        $response = $this->postJson('api/v1/orders', $data);

        $response->assertStatus(200);
        $response->assertJsonPath('message', 'Success');
        $response->assertJsonPath('data.service_id', $service[0]->id);
        $response->assertJsonPath('data.car_id', $car[0]->id);
        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'service_id' => $service[0]->id,
            'car_id' => $car[0]->id
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

    /**
     * @param int $count
     * @return Collection|HasFactory|Model|mixed
     */
    private function createOrder(int $count = 1): mixed
    {
        return Order::factory()->count($count)->create();
    }
}
