<?php

namespace App\Jobs;

use App\Console\Commands\BaseCommand;
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

/**
 * Class SyncAutoMobileJob
 * @package App\Jobs
 */
class SyncAutoMobileJob extends BaseCommand implements ShouldQueue
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
        parent::__construct();

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
        $cachedCars = Cache::get('cars');

        if ($cachedCars) {
            return $cachedCars;
        }

        $cars = $this->novassetsService->fetchAutomobiles();

        if (!$cars || !isset($cars['RECORDS']) || !count($cars['RECORDS'])) {
            $this->toSlack(config('slack.channels.service_issues'), __('Could not fetch cars from api!'));

            return;
        }

        foreach ($cars['RECORDS'] as $car) {
            $updateOrCreate = $this->carRepository->updateOrCreate($car);

            if (!$updateOrCreate) {
                $this->toSlack(config('slack.channels.db_issues'), __('Failed to create or update car!'));
            }
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
