<?php

namespace App\Console\Commands;

use App\Jobs\SyncAutoMobileJob;
use App\Repositories\BrandRepositoryInterface;
use App\Repositories\CarRepositoryInterface;
use App\Services\NovassetsService;
use App\Traits\NotifiableOnSlack;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
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
    private NovassetsService $novassetsService;
    private CarRepositoryInterface $carRepository;
    private BrandRepositoryInterface $brandRepository;

    public function __construct(
        NovassetsService         $novassetsService,
        CarRepositoryInterface   $carRepository,
        BrandRepositoryInterface $brandRepository
    )
    {
        parent::__construct();

        $this->novassetsService = $novassetsService;
        $this->carRepository = $carRepository;
        $this->brandRepository = $brandRepository;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        Queue::pushOn(
            config('queue.connections.sync'),
            new SyncAutoMobileJob($this->novassetsService, $this->carRepository, $this->brandRepository)
        );
    }
}
