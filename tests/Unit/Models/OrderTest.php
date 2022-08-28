<?php

namespace Tests\Unit\Models;

use App\Models\Car;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mockery;
use Tests\Suites\ModelTestSuite;

/**
 * Class OrderTest
 * @package Tests\Unit\Models
 * @coversDefaultClass \App\Models\Order
 */
class OrderTest extends ModelTestSuite
{
    private $orderMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->orderMock = Mockery::mock(Order::class)
            ->makePartial()
            ->shouldAllowMockingProtectedMethods();
    }

    /**
     * @test
     * @covers ::car
     */
    function it_should_belongs_to_car()
    {
        $belongsToMock = $this->createMock(BelongsTo::class);

        $this->orderMock
            ->shouldReceive('belongsTo')
            ->once()
            ->with(Car::class)
            ->andReturn($belongsToMock);

        $this->assertEquals($belongsToMock, $this->orderMock->car());
    }

    /**
     * @test
     * @covers ::service
     */
    function it_should_belongs_to_service()
    {
        $belongsToMock = $this->createMock(BelongsTo::class);

        $this->orderMock
            ->shouldReceive('belongsTo')
            ->once()
            ->with(Service::class)
            ->andReturn($belongsToMock);

        $this->assertEquals($belongsToMock, $this->orderMock->service());
    }

    /**
     * @test
     * @covers ::user
     */
    function it_should_belongs_to_user()
    {
        $belongsToMock = $this->createMock(BelongsTo::class);

        $this->orderMock
            ->shouldReceive('belongsTo')
            ->once()
            ->with(User::class)
            ->andReturn($belongsToMock);

        $this->assertEquals($belongsToMock, $this->orderMock->user());
    }
}
