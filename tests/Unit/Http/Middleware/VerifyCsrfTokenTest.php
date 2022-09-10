<?php

namespace Tests\Unit\Http\Middleware;

use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Tests\Suites\MiddlewareSuite;
use Illuminate\Foundation\Application;
use App\Http\Middleware\VerifyCsrfToken;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\HttpFoundation\Cookie;
use Illuminate\Contracts\Encryption\Encrypter;

/**
 * Class VerifyCsrfTokenTest
 * @package Tests\Unit\Http\Middleware
 * @coversDefaultClass \App\Http\Middleware\VerifyCsrfToken
 */
class VerifyCsrfTokenTest extends MiddlewareSuite
{
    /** @var Response|MockObject */
    protected $response;
    /** @var VerifyCsrfToken */
    protected $middleware;
    /** @var Application|MockObject */
    protected $application;
    /** @var Encrypter|MockObject */
    protected $encrypter;
    /** @var Store|MockObject */
    protected $session;
    /** @var ResponseHeaderBag|MockObject */
    protected $headers;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setPrerequisites();
    }

    protected function setPrerequisites(): void
    {
        parent::setPrerequisites();
        $this->response = $this->getIsolatedMock(Response::class);
        $this->application = $this->getIsolatedMock(Application::class);
        $this->encrypter = $this->getIsolatedMock(Encrypter::class);
        $this->session = $this->getIsolatedMock(Store::class);
        $this->headers = $this->getIsolatedMock(ResponseHeaderBag::class);

        $this->middleware = new VerifyCsrfToken($this->application, $this->encrypter);
    }

    /**
     * @test
     * @covers ::addCookieToResponse
     */
    function it_should_set_csrf_token_on_cookie()
    {
        Carbon::setTestNow(Carbon::now()->midDay());

        $config = Config::get('session');
        $token = 'test_token';
        $cookie = new Cookie(
            name: 'XSRF-TOKEN',
            value: $token,
            expire: Carbon::now()->getTimestamp() + 60 * $config['lifetime'],
            path: $config['path'],
            domain: $config['domain'],
            secure: $config['secure'],
            httpOnly: config('app.http_only_xsrf_token_cookie'),
            raw: false,
            sameSite: 'Lax'
        );

        $this->headers->expects($this->once())->method('setCookie')->with($cookie);
        $this->session->expects($this->once())->method('token')->willReturn($token);
        $this->request->expects($this->once())->method('session')->willReturn($this->session);
        $this->response->headers = $this->headers;

        $result = $this->invokeMethod($this->middleware, 'addCookieToResponse', [$this->request, $this->response]);


        $this->assertEquals($this->response, $result);
    }
}
