<?php

namespace Tests\Unit\Models;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mockery;
use Tests\Suites\ModelTestSuite;

/**
 * Class UserTest
 * @package Tests\Unit\Models
 * @coversDefaultClass \App\Models\User
 */
class UserTest extends ModelTestSuite
{
    private $userMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userMock = Mockery::mock(User::class)
            ->makePartial()
            ->shouldAllowMockingProtectedMethods();
    }

    /**
     * @test
     * @covers ::orders
     */
    function it_should_have_has_many_relations_with_builder_campaigns()
    {
        $hasManyMock = $this->createMock(HasMany::class);

        $this->userMock
            ->shouldReceive('hasMany')
            ->once()
            ->with(Order::class)
            ->andReturn($hasManyMock);

        $this->assertEquals($hasManyMock, $this->userMock->orders());
    }
}
