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
        if (Cache::has('cars')) {
            return Cache::get('cars');
        }

        $cars = $this->novassetsService->fetchAutomobiles();

        if (!isset($cars['RECORDS']) || !count($cars['RECORDS'])) {
            $this->toSlack(config('slack.channels.service_issues'), __('Could not fetch cars from api!'));

            return;
        }

        foreach ($cars['RECORDS'] as $car) {
            $this->syncRecords($car);
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

    /**
     * @param $record
     * @return void
     */
    private function syncRecords($record): void
    {
        $brand = $this->brandRepository->updateOrCreate([
            'name' => $record['brand'],
            'url' => $record['url'],
            'model' => $record['model'],
            'year' => $record['year'],
        ]);

        $this->carRepository->updateOrCreate([
            'brand_id' => $brand->id,
            'option' => $record['option'],
            'engine_cylinders' => $record['engine_cylinders'],
            'engine_displacement' => $record['engine_displacement'],
            'engine_power' => $record['engine_power'],
            'engine_torque' => $record['engine_torque'],
            'engine_fuel_system' => $record['engine_fuel_system'],
            'engine_fuel' => $record['engine_fuel'],
            'engine_c2o' => $record['engine_c2o'],
            'performance_top_speed' => $record['performance_top_speed'],
            'performance_acceleration' => $record['performance_acceleration'],
            'fuel_economy_city' => $record['fuel_economy_city'],
            'fuel_economy_highway' => $record['fuel_economy_highway'],
            'fuel_economy_combined' => $record['fuel_economy_combined'],
            'transmission_drive_type' => $record['transmission_drive_type'],
            'transmission_gearbox' => $record['transmission_gearbox'],
            'brakes_front' => $record['brakes_front'],
            'brakes_rear' => $record['brakes_rear'],
            'tires_size' => $record['tires_size'],
            'dimensions_length' => $record['dimensions_length'],
            'dimensions_width' => $record['dimensions_width'],
            'dimensions_height' => $record['dimensions_height'],
            'dimensions_front_rear_track' => $record['dimensions_front_rear_track'],
            'dimensions_wheelbase' => $record['dimensions_wheelbase'],
            'dimensions_ground_clearance' => $record['dimensions_ground_clearance'],
            'dimensions_cargo_volume' => $record['dimensions_cargo_volume'],
            'dimensions_cd' => $record['dimensions_cd'],
            'weight_unladen' => $record['weight_unladen'],
            'weight_limit' => $record['weight_limit'],
        ]);
    }
}
