<?php

namespace Tests;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionClass;
use ReflectionException;

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

    /**
     * @return void
     */
    protected function setPrerequisites(): void
    {
        Eloquent::unguard();
    }

    /**
     * @param $class
     * @param array $ignoreMethods
     * @return MockObject
     */
    public function getIsolatedMock($class, $ignoreMethods = [])
    {
        return $this->getDisabledConstructorMock($class, $this->getClassMethods($class, $ignoreMethods));
    }

    /**
     * @param $class
     * @param array $mockMethods
     * @return MockObject
     */
    public function getDisabledConstructorMock($class, $mockMethods = [])
    {
        return $this->getMockBuilder($class)
            ->disableOriginalConstructor()
            ->setMethods($mockMethods)
            ->getMock();
    }

    /**
     * @param Collection|array $expectedRows
     * @param Collection $actualData
     */
    public function assertSameRows($expectedRows, Collection $actualData)
    {
        $this->assertCount(count($expectedRows), $actualData, 'Collection Count Failed');

        foreach ($actualData as $key => $record) {
            $this->assertTrue($actualData->contains($expectedRows[$key]));
        }
    }

    /**
     * @param Eloquent $expectedEloquent
     * @param Eloquent $actualEloquent
     * @param array $columns
     */
    public function assertSameModel(Eloquent $expectedEloquent, Eloquent $actualEloquent, array $columns = [])
    {
        $columns = empty($columns) ? array_keys($expectedEloquent->toArray()) : $columns;
        $this->assertEquals(
            Arr::only($expectedEloquent->attributesToArray(), $columns),
            Arr::only($actualEloquent->attributesToArray(), $columns)
        );
    }

    /**
     * Call protected/private method of a class.
     * @param object &$object Instantiated object that we will run method on.
     * @param string $methodName Method name to all call.
     * @param array $parameters Array of parameters to be pass into method.
     * @throws ReflectionException
     * @return mixed Method return.
     */
    protected function invokeMethod(&$object, $methodName, array $parameters = [])
    {
        $reflection = new ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
