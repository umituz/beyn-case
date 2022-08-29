<?php

namespace Tests\Unit\Repositories;

use App\Models\Brand;
use App\Models\Car;
use App\Repositories\CarRepository;
use Tests\Suites\RepositoryTestSuite;

/**
 * Class CarRepositoryTest
 * @package Tests\Unit\Repositories
 * @coversDefaultClass \App\Repositories\CarRepository
 */
class CarRepositoryTest extends RepositoryTestSuite
{
    private $car;
    private $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setRepository();
    }

    /**
     * @return void
     */
    public function setRepository(): void
    {
        $this->car = $this
            ->getMockBuilder(Car::class)
            ->disableOriginalConstructor()
            ->addMethods(['paginate', 'find'])
            ->getMock();
        $this->repository = new CarRepository($this->car);
    }

    /**
     * @param array $methods
     * @return void
     */
    public function setMockedRepository(array $methods): void
    {
        $this->repository = $this->getMockBuilder(CarRepository::class)
            ->setConstructorArgs([$this->car])
            ->onlyMethods($methods)
            ->getMock();
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::getAll
     */
    function it_should_return_all_cars()
    {
        $this->setMockedRepository(['getAll']);

        $car = Car::factory()->make();
        $brand = Brand::factory()->make();
        $brand->id = 1;

        $expected = [
            'brand_id' => $brand->id,
            'option' => $car->option,
            'engine_cylinders' => $car->engine_cylinders,
            'engine_displacement' => $car->engine_displacement,
            'engine_power' => $car->engine_power,
            'engine_torque' => $car->engine_torque,
            'engine_fuel_system' => $car->engine_fuel_system,
            'engine_fuel' => $car->engine_fuel,
            'engine_c2o' => $car->engine_c2o,
            'performance_top_speed' => $car->performance_top_speed,
            'performance_acceleration' => $car->performance_acceleration,
            'fuel_economy_city' => $car->fuel_economy_city,
            'fuel_economy_highway' => $car->fuel_economy_highway,
            'fuel_economy_combined' => $car->fuel_economy_combined,
            'transmission_drive_type' => $car->transmission_drive_type,
            'transmission_gearbox' => $car->transmission_gearbox,
            'brakes_front' => $car->brakes_front,
            'brakes_rear' => $car->brakes_rear,
            'tires_size' => $car->tires_size,
            'dimensions_length' => $car->dimensions_length,
            'dimensions_width' => $car->dimensions_width,
            'dimensions_height' => $car->dimensions_height,
            'dimensions_front_rear_track' => $car->dimensions_front_rear_track,
            'dimensions_wheelbase' => $car->dimensions_wheelbase,
            'dimensions_ground_clearance' => $car->dimensions_ground_clearance,
            'dimensions_cargo_volume' => $car->dimensions_cargo_volume,
            'dimensions_cd' => $car->dimensions_cd,
            'weight_unladen' => $car->weight_unladen,
            'weight_limit' => $car->weight_limit
        ];

        $this->repository->expects($this->once())->method('getAll')->willReturn(collect($car));

        $this->assertSameRows(collect($expected), $this->repository->getAll());
    }
}
