<?php

namespace Tests\Unit\Http\Requests\V1\Auth;

use App\Http\Requests\V1\Auth\LoginRequest;
use Tests\Suites\RequestTestSuite;

/**
 * Class UserLoginRequestTest
 * @package Tests\Unit\Http\Requests
 * @coversDefaultClass \App\Http\Requests\V1\Auth\LoginRequest
 */
class LoginRequestTest extends RequestTestSuite
{
    /**
     * @return LoginRequest
     */
    public function getRequest(): LoginRequest
    {
        return new LoginRequest();
    }

    /**
     * @test
     * @dataProvider rulesProvider
     * @param string $field
     * @param string|array $rule
     * @return void
     */
    function it_should_validate_rules(string $field, $rule)
    {
        $this->assertSame($rule, $this->getRules()[$field]);
    }

    /**
     * @test
     * @covers ::rules
     */
    function it_should_assert_count_validation_rules()
    {
        $this->assertCount(count($this->rulesProvider()), $this->getRules());
    }

    /**
     * @return array
     */
    public function rulesProvider(): array
    {
        return [
            ['email', ['required', 'email']],
            ['password', ['required', 'min:6']],
        ];
    }
}
