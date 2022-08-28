<?php

namespace App\Console\Commands;

use App\Jobs\SyncAutoMobileJob;
use App\Repositories\CarRepositoryInterface;
use App\Services\NovassetsService;
use Illuminate\Support\Facades\Queue;

/**
 * Class SyncAutoMobile
 * @package App\Console\Commands
 */
class SyncAutoMobile extends BaseCommand
{
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

    public function __construct(NovassetsService $novassetsService, CarRepositoryInterface $carRepository)
    {
        parent::__construct();

        $this->novassetsService = $novassetsService;
        $this->carRepository = $carRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Queue::pushOn(
            config('queue.connections.sync'),
            new SyncAutoMobileJob($this->novassetsService, $this->carRepository)
        );
    }
}
