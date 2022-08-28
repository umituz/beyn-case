<?php

namespace Tests\Unit\Http\Requests\Statistics;

use App\Http\Requests\Request;
use App\Http\Requests\Statistics\OverallStatisticsRequest;
use Tests\Suites\RequestTestSuite;

/**
 * Class OverallSummaryStatisticsRequestTest
 * @package Tests\Unit\Http\Requests\Statistics
 * @coversDefaultClass \App\Http\Requests\Statistics\OverallStatisticsRequest
 */
class OverallStatisticsRequestTest extends RequestTestSuite
{
    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return new OverallStatisticsRequest();
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
            ['partner', 'required|string|max:40'],
            ['startTime', 'required|numeric'],
            ['endTime', 'required|numeric|gte:startTime'],
        ];
    }
}
