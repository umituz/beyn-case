<?php

namespace App\Console\Commands;

use App\Jobs\SyncAutoMobileJob;
use App\Repositories\BrandRepositoryInterface;
use App\Repositories\CarRepositoryInterface;
use App\Services\NovassetsService;
use App\Traits\NotifiableOnSlack;
use Illuminate\Support\Facades\Queue;

/**
 * Class SyncAutoMobile
 * @package App\Console\Commands
 */
class SyncAutoMobile extends BaseCommand
{
    use NotifiableOnSlack;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:automobile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync with the latest car models';

    public function __construct(
        protected NovassetsService         $novassetsService,
        protected CarRepositoryInterface   $carRepository,
        protected BrandRepositoryInterface $brandRepository
    )
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        Queue::pushOn(
            config('queue.connections.redis.driver'),
            new SyncAutoMobileJob($this->novassetsService, $this->carRepository, $this->brandRepository)
        );
    }
}
