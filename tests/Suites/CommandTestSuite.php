<?php

namespace Tests\Suites;

use App\Console\Commands\BaseCommand;
use Illuminate\Support\Facades\Queue;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputOption;
use Tests\TestCase;

/**
 * Class CommandTestSuite.
 * @package Test\Suites
 */
abstract class CommandTestSuite extends TestCase
{
    protected $dispatchedJobs = [];
    protected array $delayedJobs = [];
    protected array $onQueueDispatchedJobs = [];
    protected array $onQueueDelayedJobs = [];
    protected array $arguments = [];

    /** @var BaseCommand $command */
    public BaseCommand $command;

    protected function setPrerequisites(): void
    {
        $this->countDispatchedJobs();
        $this->countDelayedJobs();
        $this->countOnQueueDispatchedJobs();
        $this->countOnQueueDelayedJobs();
        parent::setPrerequisites();
    }

    /**
     * @param  string  $name
     * @param  string|null  $default
     */
    protected function setArgument(string $name, string $default = null)
    {
        $this->arguments[] = new InputArgument($name, $default ? InputArgument::OPTIONAL : null, '', $default);
    }

    /**
     * @param  string  $name
     * @param  string|null  $default
     * @param  string|null  $shortcut
     * @return void
     */
    protected function setOption(string $name, string $default = null, string $shortcut = null): void
    {
        $this->arguments[] = new InputOption(
            $name,
            $shortcut,
            $default ? InputOption::VALUE_OPTIONAL : InputOption::VALUE_REQUIRED,
            '',
            $default
        );
    }

    /**
     * @param  int  $expectedCount
     * @param  string  $queue
     * @param  string  $jobName
     * @return void
     */
    protected function assertCountOnDispatchedJob(int $expectedCount, string $queue, string $jobName): void
    {
        $this->assertEquals($expectedCount, $this->onQueueDispatchedJobs[$jobName][$queue] ?? 0);
    }

    /**
     * @param  int  $expectedCount
     * @param  string  $jobName
     */
    protected function assertCountDispatchedJob(int $expectedCount, string $jobName)
    {
        $this->assertEquals($expectedCount, $this->dispatchedJobs[$jobName] ?? 0);
    }

    /**
     * @param  int  $expectedCount
     * @param  string  $jobName
     * @param  int  $delay
     */
    protected function assertCountDelayedJobs(int $expectedCount, string $jobName, int $delay)
    {
        $this->assertEquals($expectedCount, $this->delayedJobs[$jobName][$delay] ?? 0);
    }

    /**
     * @param  int  $expectedCount
     * @param  string  $queue
     * @param  string  $jobName
     * @param  int  $delay
     */
    protected function assertCountOnDelayedJobs(int $expectedCount, string $queue, string $jobName, int $delay)
    {
        $this->assertEquals($expectedCount, $this->onQueueDelayedJobs[$jobName][$delay][$queue] ?? 0);
    }

    /**
     * @param  string  $jobName
     * @param  int  $delay
     */
    protected function assertJobHasDelay(string $jobName, int $delay)
    {
        $this->assertCountDelayedJobs(1, $jobName, $delay);
    }

    /**
     * @param  BaseCommand  $command
     * @return BaseCommand
     */
    protected function prepareCommand(BaseCommand $command): BaseCommand
    {
        $this->command = $command;
        $this->command->initializeInput();
        $this->command->initializeOutput();
        $this->command->bindDefinition(new InputDefinition($this->arguments));

        return $this->command;
    }

    /**
     * @param  BaseCommand  $command
     * @param  mixed|null  $arg
     * @return mixed
     */
    protected function executeCommand(BaseCommand $command, $arg = null)
    {
        return $this->prepareCommand($command)->handle($arg);
    }

    /**
     * @param  string  $command
     * @param  array  $excludedMethods
     * @param  array  $constructorArgs
     * @return MockObject
     */
    protected function mockCommand(string $command, array $excludedMethods, array $constructorArgs): MockObject
    {
        return $this->getMockBuilder($command)
            ->addMethods($this->getClassMethods($command, $excludedMethods))
            ->setConstructorArgs($constructorArgs)
            ->getMock();
    }

    protected function countDispatchedJobs()
    {
        Queue::shouldReceive('push')
            ->andReturnUsing(function ($job) {
                $jobName = get_class($job);

                if (isset($this->dispatchedJobs[$jobName])) {
                    return $this->dispatchedJobs[$jobName]++;
                }

                return $this->dispatchedJobs[$jobName] = 1;
            });
    }

    /**
     * @return void
     */
    protected function countDelayedJobs(): void
    {
        Queue::shouldReceive('later')
            ->andReturnUsing(function ($delay, $job) {
                $jobName = get_class($job);

                if (isset($this->delayedJobs[$jobName][$delay])) {
                    return $this->delayedJobs[$jobName][$delay]++;
                }

                return $this->delayedJobs[$jobName][$delay] = 1;
            });
    }

    /**
     * @return void
     */
    protected function countOnQueueDispatchedJobs(): void
    {
        Queue::shouldReceive('pushOn')
            ->andReturnUsing(function ($queue, $job) {
                $currentJob = get_class($job);

                if (isset($this->onQueueDispatchedJobs[$currentJob][$queue])) {
                    return $this->onQueueDispatchedJobs[$currentJob][$queue]++;
                }

                return $this->onQueueDispatchedJobs[$currentJob][$queue] = 1;
            });
    }

    /**
     * @return void
     */
    protected function countOnQueueDelayedJobs(): void
    {
        Queue::shouldReceive('laterOn')
            ->andReturnUsing(function ($queue, $delay, $job) {
                $currentJob = get_class($job);

                if (isset($this->onQueueDelayedJobs[$currentJob][$delay][$queue])) {
                    return $this->onQueueDelayedJobs[$currentJob][$delay][$queue]++;
                }

                return $this->onQueueDelayedJobs[$currentJob][$delay][$queue] = 1;
            });
    }
}
