<?php

namespace Tests\Feature\Controllers\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\Feature\BaseTestCase;

/**
 * Class UsersV1ControllerTest
 * @package Tests\Feature\Car
 * @coversDefaultClass \App\Http\Controllers\Api\User\UsersV1Controller
 */
class UsersV1ControllerTest extends BaseTestCase
{
    use RefreshDatabase;

    const PROFILE_ENDPOINT = 'api/account/profile?version=1';
    const BALANCE_ENDPOINT = 'api/account/balance?version=1';

    /**
     * @test
     * @covers ::profile
     * @covers ::__construct
     */
    public function it_should_return_user_account()
    {
        $user = $this->createUser(123456);
        Sanctum::actingAs($user, ['*']);

        $response = $this->getJson(self::PROFILE_ENDPOINT);


        $response->assertStatus(200);
        $response->assertJsonPath('data.name', $user->name);
        $this->assertDatabaseHas('users', ['id' => $user->id]);
    }

    /**
     * @test
     * @covers ::balance
     */
    public function it_should_not_return_user_profile_with_wrong_credentials()
    {
        $response = $this->getJson(self::PROFILE_ENDPOINT);

        $response->assertStatus(401);
        $response->assertJsonPath('message', 'Unauthenticated.');
    }

    /**
     * @test
     * @covers ::balance
     */
    public function it_should_update_user_balance()
    {
        $user = $this->createUser(123456);
        Sanctum::actingAs($user, ['*']);
        $data = [
            'amount' => 120,
            'type' => 'deposit',
            'fullname' => fake()->firstName . ' ' . fake()->lastName,
            'card_number' => fake()->creditCardNumber,
            'expiry_month' => 02,
            'expiry_year' => fake()->year,
            'cvc' => 999,
        ];

        $response = $this->putJson(self::BALANCE_ENDPOINT, $data);

        $response->assertStatus(200);
        $response->assertJsonPath('message', 'Success');
        $response->assertJsonPath('data.balance', 120);
        $this->assertDatabaseHas('users', ['balance' => 120]);
    }

    /**
     * @test
     * @covers ::balance
     */
    public function it_should_not_update_balance_with_wrong_credentials()
    {
        $response = $this->putJson(self::BALANCE_ENDPOINT);

        $response->assertStatus(401);
        $response->assertJsonPath('message', 'Unauthenticated.');
    }

    /**
     * @test
     * @covers ::balance
     */
    public function it_should_not_update_without_amount()
    {
        $user = $this->createUser(123456);
        Sanctum::actingAs($user, ['*']);
        $response = $this->putJson(self::BALANCE_ENDPOINT);

        $response->assertStatus(422);
        $response->assertJsonPath('errors.amount.0', 'The amount field is required.');
    }
}
