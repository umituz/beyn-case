<?php

namespace App\Console\Commands;

use App\Repositories\CarRepositoryInterface;
use App\Services\NovassetsService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CheckAutoMobile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:automobile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync with the latest car models';

    /**
     * @var NovassetsService
     */
    private NovassetsService $novassetsService;

    /**
     * @var CarRepositoryInterface
     */
    private CarRepositoryInterface $carRepository;

    /**
     * @param NovassetsService $novassetsService
     */
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
        $cars = $this->novassetsService->fetchAutomobiles();

        if (json_encode($cars) === Cache::get('cars')) {
            $this->warn('Couldn\'t find a tool to update or created!');
            return 0;
        }

        if (!$cars || !isset($cars['RECORDS']) || !count($cars['RECORDS'])) {
            $this->error('Could not fetch cars from api!');
            return 0;
        }

        foreach ($cars['RECORDS'] as $car) {
            $updateOrCreate = $this->carRepository->updateOrCreate($car);

            if (!$updateOrCreate) {
                $this->error('Failed to create or update car!');
            }
        }

        $redis = Cache::put('cars', json_encode($cars));

        if (!$redis) {
            $this->error('Failed to register to redis!');
        }

        $this->info('All cars added or updated');

        return 1;
    }
}
