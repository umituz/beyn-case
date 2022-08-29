<?php

namespace Tests\Unit\Http\Requests\V1\Brand;

use App\Http\Requests\V1\Brand\BrandRequest;
use Tests\Suites\RequestTestSuite;

/**
 * Class BrandRequestTest
 * @package Tests\Unit\Http\Requests\V1\Brand
 * @coversDefaultClass \App\Http\Requests\V1\Brand\BrandRequest
 */
class BrandRequestTest extends RequestTestSuite
{
    /**
     * @return BrandRequest
     */
    public function getRequest(): BrandRequest
    {
        return new BrandRequest();
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
            ['name', ['required', 'string', 'max:191']],
            ['model', ['required', 'string', 'max:191']],
            ['url', ['required', 'string', 'url', 'max:191']],
            ['year', ['required', 'string', 'max:191']],
        ];
    }
}
