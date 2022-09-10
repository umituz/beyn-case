<?php

namespace Tests\Unit\Http\Requests\V1\Service;

use App\Http\Requests\V1\Service\ServiceRequest;
use Tests\Suites\RequestTestSuite;

/**
 * Class ServiceRequestTest
 * @package Tests\Unit\Http\Requests\V1\Car
 * @coversDefaultClass \App\Http\Requests\V1\Service\ServiceRequest
 */
class ServiceRequestTest extends RequestTestSuite
{
    /**
     * @return ServiceRequest
     */
    public function getRequest(): ServiceRequest
    {
        return new ServiceRequest();
    }

    /**
     * @test
     * @dataProvider rulesProvider
     * @param string $field
     * @param array|string $rule
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
            ['name', ['required', 'string', 'max:191']],
            ['price', ['required', 'numeric']],
        ];
    }
}
