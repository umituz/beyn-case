<?php

namespace Tests\Unit\Models;

use App\Models\Car;
use App\Models\Order;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mockery;
use Tests\Suites\ModelTestSuite;

/**
 * Class CarTest
 * @package Tests\Unit\Models
 * @coversDefaultClass \App\Models\Car
 */
class CarTest extends ModelTestSuite
{
    private $carMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->carMock = Mockery::mock(Car::class)
            ->makePartial()
            ->shouldAllowMockingProtectedMethods();
    }

    /**
     * @test
     * @covers ::orders
     */
    function it_should_have_has_many_relations_with_orders()
    {
        $hasManyMock = $this->createMock(HasMany::class);

        $this->carMock
            ->shouldReceive('hasMany')
            ->once()
            ->with(Order::class)
            ->andReturn($hasManyMock);

        $this->assertEquals($hasManyMock, $this->carMock->orders());
    }
}
