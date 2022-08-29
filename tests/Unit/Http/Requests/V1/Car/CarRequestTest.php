<?php

namespace Tests\Unit\Http\Requests\V1\Car;

use App\Http\Requests\V1\Car\CarRequest;
use Tests\Suites\RequestTestSuite;

/**
 * Class CarRequestTest
 * @package Tests\Unit\Http\Requests\V1\Car
 * @coversDefaultClass \App\Http\Requests\V1\Car\CarRequest
 */
class CarRequestTest extends RequestTestSuite
{
    /**
     * @return CarRequest
     */
    public function getRequest(): CarRequest
    {
        return new CarRequest();
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
            ['brand_id', ['required', 'integer']],
            ['option', ['nullable', 'string', 'max:191']],
            ['engine_cylinders', ['nullable', 'string', 'max:191']],
            ['engine_displacement', ['nullable', 'string', 'max:191']],
            ['engine_power', ['nullable', 'string', 'max:191']],
            ['engine_torque', ['nullable', 'string', 'max:191']],
            ['engine_fuel_system', ['nullable', 'string', 'max:191']],
            ['engine_fuel', ['nullable', 'string', 'max:191']],
            ['engine_c2o', ['nullable', 'string', 'max:191']],
            ['performance_top_speed', ['nullable', 'string', 'max:191']],
            ['performance_acceleration', ['nullable', 'string', 'max:191']],
            ['fuel_economy_city', ['nullable', 'string', 'max:191']],
            ['fuel_economy_highway', ['nullable', 'string', 'max:191']],
            ['fuel_economy_combined', ['nullable', 'string', 'max:191']],
            ['transmission_drive_type', ['nullable', 'string', 'max:191']],
            ['transmission_gearbox', ['nullable', 'string', 'max:191']],
            ['brakes_front', ['nullable', 'string', 'max:191']],
            ['brakes_rear', ['nullable', 'string', 'max:191']],
            ['tires_size', ['nullable', 'string', 'max:191']],
            ['dimensions_length', ['nullable', 'string', 'max:191']],
            ['dimensions_width', ['nullable', 'string', 'max:191']],
            ['dimensions_height', ['nullable', 'string', 'max:191']],
            ['dimensions_front_rear_track', ['nullable', 'string', 'max:191']],
            ['dimensions_wheelbase', ['nullable', 'string', 'max:191']],
            ['dimensions_ground_clearance', ['nullable', 'string', 'max:191']],
            ['dimensions_cargo_volume', ['nullable', 'string', 'max:191']],
            ['dimensions_cd', ['nullable', 'string', 'max:191']],
            ['weight_unladen', ['nullable', 'string', 'max:191']],
            ['weight_limit', ['nullable', 'string', 'max:191']],
        ];
    }
}
