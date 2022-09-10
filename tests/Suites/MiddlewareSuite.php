<?php

namespace Tests\Suites;

use App\Http\Requests\Request;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request as HttpRequest;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

/**
 * Class MiddlewareSuite
 * @package Tests\Suites
 */
abstract class MiddlewareSuite extends TestCase
{
    use WithFaker;

    /**
     * @var HttpRequest|MockObject
     */
    protected $request;

    /**
     * @var RedirectResponse|MockObject
     */
    protected $redirectResponse;

    /**
     * @inheritdoc
     */
    protected function setPrerequisites(): void
    {
        parent::setPrerequisites();
        // Note: It is not allow to mock Request directly using facades due to request implications
        // Please check laravel doc for more details.
        $this->request = $this->getIsolatedMock(Request::class);
        $this->redirectResponse = $this->createMock(RedirectResponse::class);
    }

    /**
     * @param $middleware
     * @param null $expected
     * @param string $assertion
     */
    protected function assertMiddlewareResponse($middleware, $expected = null, $assertion = 'assertEquals')
    {
        $this->{$assertion}($expected, $this->callHandleMethod($middleware)->getContent());
    }

    /**
     * Call handle method on given middleware
     * @param $middleware
     * @return mixed
     */
    protected function callHandleMethod($middleware)
    {
        return $middleware->handle($this->request, function () {
            return $this->request;
        });
    }

    /**
     * @return array
     */
    public function responseDataProvider(): array
    {
        return [];
    }
}
