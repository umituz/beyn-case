<?php

namespace App\Jobs;

use App\Console\Commands\BaseCommand;
use App\Repositories\BrandRepositoryInterface;
use App\Repositories\CarRepositoryInterface;
use App\Services\NovassetsService;
use App\Traits\NotifiableOnSlack;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

/**
 * Class SyncAutoMobileJob
 * @package App\Jobs
 */
class SyncAutoMobileJob extends BaseCommand implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, NotifiableOnSlack;

    private NovassetsService $novassetsService;
    private CarRepositoryInterface $carRepository;
    private BrandRepositoryInterface $brandRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        NovassetsService $novassetsService,
        CarRepositoryInterface $carRepository,
        BrandRepositoryInterface $brandRepository
    )
    {
        parent::__construct();

        $this->novassetsService = $novassetsService;
        $this->carRepository = $carRepository;
        $this->brandRepository = $brandRepository;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $cars = File::get(public_path('automobile.json'));

        #$cachedCars = Cache::get('cars');

        #if ($cachedCars) {
        #    return $cachedCars;
        #}

        #$cars = $this->novassetsService->fetchAutomobiles();

        if (!$cars || !isset($cars['RECORDS']) || !count($cars['RECORDS'])) {
            $this->toSlack(config('slack.channels.service_issues'), __('Could not fetch cars from api!'));

            return;
        }

        foreach ($cars['RECORDS'] as $car) {
            $this->carRepository->updateOrCreate($car);
            $this->brandRepository->updateOrCreate($car);
        }

        $redis = Cache::put('cars', json_encode($cars));

        if (!$redis) {
            $this->toSlack(config('slack.channels.redis_issues'), __('Failed to register to redis!'));
        }
    }

    /**
     * @param Exception $exception
     * @return bool
     */
    public function failed(Exception $exception): bool
    {
        $this->toSlack(
            config('slack.channels.failed_jobs'),
            "Failed while sync cars " .
            "Exception message: ```{$exception->getMessage()}```"
        );

        return true;
    }
}
