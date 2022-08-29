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
    const DEPOSIT_TYPE = 'deposit';
    const WITHDRAW_TYPE = 'withdraw';

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
            ['type', ['required', 'string', 'in:' . self::DEPOSIT_TYPE . ',' . self::WITHDRAW_TYPE]],
            ['fullname', ['required', 'string', 'max:40', 'min:3']],
            ['card_number', ['required', 'numeric', 'max:16', 'min:16']],
            ['expiry_month', ['required', 'numeric', 'max:2', 'min:2']],
            ['expiry_year', ['required', 'numeric', 'max:4', 'min:4']],
            ['cvc', ['required', 'numeric', 'max:3', 'min:3']],
        ];
    }
}
