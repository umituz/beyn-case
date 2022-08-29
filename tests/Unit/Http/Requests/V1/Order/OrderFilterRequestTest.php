<?php

namespace Tests\Unit\Http\Requests\V1\Order;

use App\Http\Requests\V1\Order\OrderFilterRequest;
use Tests\Suites\RequestTestSuite;

/**
 * Class UserOrderFilterV1RequestTest
 * @package Tests\Unit\Http\Requests
 * @coversDefaultClass \App\Http\Requests\V1\Order\OrderFilterRequest
 */
class OrderFilterRequestTest extends RequestTestSuite
{
    /**
     * @return OrderFilterRequest
     */
    public function getRequest(): OrderFilterRequest
    {
        return new OrderFilterRequest();
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
