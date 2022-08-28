<?php

namespace Tests\Suites;

use Tests\TestCase;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ResourceTestSuite
 * @package Tests\Suites
 */
abstract class ResourceTestSuite extends TestCase
{
    /**
     * @param array $expectation
     * @param JsonResource $resource
     */
    public function assertResource($expectation, JsonResource $resource)
    {
        $this->assertEquals($expectation, $resource->resolve());
    }
}
