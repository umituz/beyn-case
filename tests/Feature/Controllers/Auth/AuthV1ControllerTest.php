<?php

namespace Tests\Feature\Controllers\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\Feature\BaseTestCase;

/**
 * Class AuthV1ControllerTest
 * @package Tests\Feature\Auth
 * @coversDefaultClass \App\Http\Controllers\Api\Auth\AuthV1Controller
 */
class AuthV1ControllerTest extends BaseTestCase
{
    use RefreshDatabase;

    const LOGIN_ENDPOINT = 'api/auth/login?version=1';
    const REGISTER_ENDPOINT = 'api/auth/register?version=1';

    /**
     * @test
     * @covers ::login
     * @covers ::__construct
     */
    function it_should_login_when_user_has_correct_credentials()
    {
        $user = $this->createUser(123456);
        $data = [
            'email' => $user->email,
            'password' => 123456
        ];

        $response = $this->postJson(self::LOGIN_ENDPOINT, $data);

        $response->assertStatus(200);
        $response->assertJsonPath('message', 'Success');
        $response->assertJsonPath('data.id', $user->id);
        $this->assertNotNull('data.access_token');
    }

    /**
     * @test
     * @covers ::login
     */
    function it_should_not_login_when_request_has_missing_parameters()
    {
        $response = $this->postJson(self::LOGIN_ENDPOINT);

        $response->assertStatus(422);
        $response->assertJsonPath('errors.email.0', 'The email field is required.');
        $response->assertJsonPath('errors.password.0', 'The password field is required.');
    }

    /**
     * @test
     * @covers ::login
     */
    function it_should_not_login_when_request_has_incorrect_credentials()
    {
        $user = $this->createUser(123456);
        $data = [
            'email' => $user->email,
            'password' => fake()->password
        ];

        $response = $this->postJson(self::LOGIN_ENDPOINT, $data);

        $response->assertStatus(403);
        $response->assertJsonPath('message', 'Email or password is incorrect!');
    }

    /**
     * @test
     * @covers ::register
     */
    function it_should_register_when_request_credentials_are_acceptable()
    {
        $data = $this->getRegisterData();

        $response = $this->postJson(self::REGISTER_ENDPOINT, $data);

        $response->assertStatus(200);
        $response->assertJsonPath('message', 'Success');
        $response->assertJsonPath('data.name', $data['name']);
        $response->assertJsonPath('data.email', $data['email']);
        $this->assertDatabaseHas('users', ['email' => $data['email'], 'name' => $data['name']]);
        $this->assertDatabaseCount('users', 1);
    }

    /**
     * @test
     * @covers ::register
     */
    function it_should_not_register_use_when_request_has_missing_parameters()
    {
        $data = $this->getRegisterData();
        unset($data['email']);

        $response = $this->postJson(self::REGISTER_ENDPOINT, $data);

        $response->assertStatus(422);
        $response->assertJsonPath('errors.email.0', 'The email field is required.');
        $this->assertDatabaseMissing('users', ['name' => $data['name'],]);
        $this->assertDatabaseCount('users', 0);
    }

    /**
     * @test
     * @covers ::register
     */
    function it_should_not_register_user_when_request_has_existing_email()
    {
        User::factory()->create(['password' => Hash::make(123456), 'email' => 'test@test.com']);

        $data = $this->getRegisterData();

        $response = $this->postJson(self::REGISTER_ENDPOINT, $data);

        $response->assertStatus(422);
        $response->assertJsonPath('errors.email.0', 'The email has already been taken.');
        $this->assertDatabaseMissing('users', ['name' => $data['name'],]);
        $this->assertDatabaseCount('users', 1);
    }

    /**
     * @return string[]
     */
    private function getRegisterData(): array
    {
        return [
            'name' => 'Name',
            'email' => 'test@test.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'balance' => 0.00
        ];
    }
}
