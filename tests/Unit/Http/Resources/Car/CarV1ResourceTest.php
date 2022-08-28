<?php

namespace Tests\Unit\Http\Resources\Car;

use App\Http\Resources\Car\CarV1Resource;
use Illuminate\Http\Request;
use Tests\Suites\ResourceTestSuite;

/**
 * Class CarV1ResourceTest
 * @package Tests\Unit\Http\Resources\Car
 * @coversDefaultClass \App\Http\Resources\Car\CarV1Resource
 */
class CarV1ResourceTest extends ResourceTestSuite
{
    /**
     * @test
     * @covers ::toArray
     */
    public function it_should_return_to_array()
    {
        $expectedData = [];

        $request = $this->createMock(Request::class);
        $listResource = $this->getMockBuilder(CarV1Resource::class)
            ->setConstructorArgs([])
            ->onlyMethods([])
            ->getMock();

        $this->assertEquals($expectedData, $listResource->toArray($request));
    }
}
