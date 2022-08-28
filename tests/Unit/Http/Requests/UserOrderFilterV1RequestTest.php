<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\Request;
use App\Http\Requests\UserOrderFilterV1Request;
use Tests\Suites\RequestTestSuite;

/**
 * Class UserOrderFilterV1RequestTest
 * @package Tests\Unit\Http\Requests
 * @coversDefaultClass \App\Http\Requests\UserOrderFilterV1Request
 */
class UserOrderFilterV1RequestTest extends RequestTestSuite
{
    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return new UserOrderFilterV1Request();
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
            ['service_id', ['nullable', 'integer']],
            ['car_id', ['nullable', 'integer']],
            ['status', ['nullable']],
        ];
    }
}
