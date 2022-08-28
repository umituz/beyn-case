<?php

namespace Tests\Unit\Models;

use App\Models\Order;
use App\Models\Service;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mockery;
use Tests\Suites\ModelTestSuite;

/**
 * Class ServiceTest
 * @package Tests\Unit\Models
 * @coversDefaultClass \App\Models\Service
 */
class ServiceTest extends ModelTestSuite
{
    private $serviceMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->serviceMock = Mockery::mock(Service::class)
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

        $this->serviceMock
            ->shouldReceive('hasMany')
            ->once()
            ->with(Order::class)
            ->andReturn($hasManyMock);

        $this->assertEquals($hasManyMock, $this->serviceMock->orders());
    }
}
