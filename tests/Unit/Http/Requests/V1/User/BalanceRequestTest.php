<?php

namespace Tests\Unit\Http\Requests\V1\User;

use App\Http\Requests\V1\User\BalanceRequest;
use Tests\Suites\RequestTestSuite;

/**
 * Class BalanceRequestTest
 * @package Tests\Unit\Http\Requests
 * @coversDefaultClass \App\Http\Requests\V1\User\BalanceRequest
 */
class BalanceRequestTest extends RequestTestSuite
{
    /**
     * @return BalanceRequest
     */
    public function getRequest(): BalanceRequest
    {
        return new BalanceRequest();
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
            ['type', ['required', 'string']],
        ];
    }
}
