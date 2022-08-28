<?php

namespace Tests\Unit\Console\Commands;

use App\Console\Commands\SyncAutoMobile;
use App\Jobs\SyncAutoMobileJob;
use App\Repositories\CarRepositoryInterface;
use App\Services\NovassetsService;
use Illuminate\Support\Facades\Queue;
use Tests\Suites\CommandTestSuite;

/**
 * Class SyncAutomobileTest.
 * @package Tests\Unit\Console\Commands
 * @coversDefaultClass \App\Console\Commands\SyncAutoMobile
 */
class SyncAutomobileTest extends CommandTestSuite
{
    /**
     * @test
     * @covers ::handle
     * @covers ::__construct
     */
    public function it_should_set_overall_analytics_check_jobs()
    {
        Queue::fake();

        $novasetsServiceMock = $this->getMockBuilder(NovassetsService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $carRepositoryMock = $this->getMockBuilder(CarRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->executeCommand(new SyncAutoMobile($novasetsServiceMock, $carRepositoryMock));

        Queue::assertPushed(SyncAutoMobileJob::class);
    }
}
