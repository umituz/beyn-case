<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\Request;
use App\Http\Requests\UserBalanceV1Request;
use Tests\Suites\RequestTestSuite;

/**
 * Class UserBalanceV1RequestTest
 * @package Tests\Unit\Http\Requests
 * @coversDefaultClass \App\Http\Requests\UserBalanceV1Request
 */
class UserBalanceV1RequestTest extends RequestTestSuite
{
    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return new UserBalanceV1Request();
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
            ['amount', ['required', 'numeric']],
        ];
    }
}
