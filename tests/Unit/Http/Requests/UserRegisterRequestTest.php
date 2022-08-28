<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\Request;
use App\Http\Requests\UserRegisterRequest;
use Tests\Suites\RequestTestSuite;

/**
 * Class UserRegisterRequestTest
 * @package Tests\Unit\Http\Requests
 * @coversDefaultClass \App\Http\Requests\UserRegisterRequest
 */
class UserRegisterRequestTest extends RequestTestSuite
{
    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return new UserRegisterRequest();
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
            ['name', ['required', 'string']],
            ['email', ['required', 'email', 'unique:users,email']],
            ['password', ['required', 'min:6']],
            ['password_confirmation', ['required', 'min:6', 'same:password']],
        ];
    }
}
