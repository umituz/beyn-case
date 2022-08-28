<?php

namespace Tests\Suites;

use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

/**
 * Class JobTestSuite
 * @package Tests\Suites
 */
abstract class JobTestSuite extends TestCase
{
    /**
     * @var Log|MockObject
     */
    protected $log;

    /**
     * @return string
     */
    protected function getJobClassName(): string
    {
        return '';
    }

    /**
     * Get the Job handle dependencies.
     *
     * @return array
     */
    abstract protected function getHandlerDependencies(): array;

    /**
     * @inheritdoc
     */
    protected function setPrerequisites(): void
    {
        parent::setPrerequisites();
        $this->log = Log::shouldReceive('info');
    }

    /**
     * @return MockObject[]
     */
    protected function mockHandlerDependencies(): array
    {
        $dependencies = [];

        foreach ($this->getHandlerDependencies() as $jobDependency) {
            $dependencies[] = $this->createMock($jobDependency);
        }

        return $dependencies;
    }

    /**
     * @param  array  $ignoreMethods
     * @return MockObject
     */
    protected function getJobMock(array $ignoreMethods = ['handle']): MockObject
    {
        return $this->getIsolatedMock($this->getJobClassName(), $ignoreMethods);
    }
}
