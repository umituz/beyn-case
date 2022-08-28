<?php

namespace Tests\Unit\Jobs;

use App\Jobs\SyncAutoMobileJob;
use App\Repositories\CarRepositoryInterface;
use App\Services\NovassetsService;
use Exception;
use Tests\Suites\JobTestSuite;

/**
 * Class SyncAutomobileJobTest
 * @package Tests\Unit\Jobs
 * @coversDefaultClass \App\Jobs\SyncAutoMobileJob
 */
class SyncAutomobileJobTest extends JobTestSuite
{
    private $novasetsService;
    private $carRepository;
    /**
     * @return string
     */
    protected function getJobClassName(): string
    {
        return SyncAutoMobileJob::class;
    }

    /**
     * @return string[]
     */
    protected function getHandlerDependencies(): array
    {
        return [NovassetsService::class, CarRepositoryInterface::class];
    }

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        [$novasetsService, $carRepository] = $this->mockHandlerDependencies();

        $this->novasetsService = $novasetsService;
        $this->carRepository = $carRepository;
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::handle
     */
    function it_should_sync_automobiles()
    {
        $completeRequester = $this->getMockBuilder($this->getJobClassName())
            ->onlyMethods([])
            ->setConstructorArgs([$this->novasetsService, $this->carRepository])
            ->getMock();

        $this->novasetsService->expects($this->once())->method('fetchAutomobiles')->willReturn([
            "RECORDS" => []
        ]);

        $completeRequester->handle($this->novasetsService);
    }

    /**
     * @test
     * @covers ::failed
     */
    function it_should_send_exception_message_to_the_slack()
    {
        $exception = new Exception(fake()->word);
        $syncAutomobileJob = $this->getMockBuilder($this->getJobClassName())
            ->onlyMethods(['toSlack'])
            ->setConstructorArgs([$this->novasetsService, $this->carRepository])
            ->getMock();

        $slackMessage = "Failed while sync cars " .
            "Exception message: ```{$exception->getMessage()}```";

        $syncAutomobileJob->expects($this->once())->method('toSlack')->with(config('slack.channels.failed_jobs'), $slackMessage);

        $syncAutomobileJob->failed($exception);
    }

}
