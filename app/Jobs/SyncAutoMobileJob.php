<?php

namespace App\Jobs;

use App\Repositories\CarRepositoryInterface;
use App\Services\NovassetsService;
use App\Traits\NotifiableOnSlack;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

/**
 * Class SyncAutoMobileJob
 * @package App\Jobs
 */
class SyncAutoMobileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, NotifiableOnSlack;

    private NovassetsService $novassetsService;
    private CarRepositoryInterface $carRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(NovassetsService $novassetsService, CarRepositoryInterface $carRepository)
    {
        $this->novassetsService = $novassetsService;
        $this->carRepository = $carRepository;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       # $cars = $this->novassetsService->fetchAutomobiles();

        #if (json_encode($cars) === Cache::get('cars')) {
            $this->toSlack('sync_automobiles', __('Couldn\'t find a tool to update or created!'));

         #   return;
        #}


    }
}
