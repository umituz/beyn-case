<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use PHPUnit\Framework\MockObject\MockObject;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Create a trait mock including mocking all the methods except ignored once and disabling constructor.
     *
     * @param $class
     * @param  array  $ignoreMethods
     * @return MockObject
     */
    public function getIsolatedTraitMock($class, array $ignoreMethods = []): MockObject
    {
        return $this->getMockForTrait(
            $class,
            [],
            '',
            false,
            true,
            true,
            $this->getClassMethods($class, $ignoreMethods)
        );
    }

    /**
     * @param $class
     * @param  array  $ignoreMethods
     * @return array
     */
    public function getClassMethods($class, array $ignoreMethods = []): array
    {
        return array_diff(get_class_methods($class), array_merge($ignoreMethods, ['__construct']));
    }
}
