<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\Request;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

/**
 * Class RequestTest.
 * @package Tests\Unit\Http\Requests
 * @coversDefaultClass \App\Http\Requests\Request
 */
class RequestTest extends TestCase
{
    /**
     * @test
     * @covers ::authorize
     */
    public function it_should_return_authorize_true()
    {
        $request = new class extends Request {
        };
        
        $this->assertTrue($request->authorize());
    }

    /**
     * @test
     * @covers ::getBase64Decoded
     */
    public function it_should_return_base_64_decoded_value_of_given_key()
    {
        /** @var Request|MockObject $request */
        $request = $this->getMockBuilder(Request::class)->onlyMethods(['get'])->getMock();

        $request->expects($this->once())
            ->method('get')
            ->with('code')
            ->willReturn(base64_encode('console.log("Ң\a" + "ある%");'));

        $this->assertEquals('console.log("Ң\a" + "ある%");', $request->getBase64Decoded('code'));
    }
}
