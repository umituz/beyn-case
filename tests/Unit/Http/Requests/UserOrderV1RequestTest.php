<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\Request;
use App\Http\Requests\UserOrderV1Request;
use Tests\Suites\RequestTestSuite;

/**
 * Class UserOrderV1RequestTest
 * @package Tests\Unit\Http\Requests
 * @coversDefaultClass \App\Http\Requests\UserOrderV1Request
 */
class UserOrderV1RequestTest extends RequestTestSuite
{
    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return new UserOrderV1Request();
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
            ['service_id', ['required', 'integer']],
            ['car_id', ['required', 'integer']],
            ['price', ['nullable', 'integer']],
        ];
    }
}
