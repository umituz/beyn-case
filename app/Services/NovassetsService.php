<?php

namespace App\Services;

use App\Repositories\CarRepositoryInterface;
use Illuminate\Support\Facades\Http;

class NovassetsService
{
    const API_URL = 'https://static.novassets.com';

    /**
     * @var CarRepositoryInterface
     */
    private CarRepositoryInterface $carRepository;

    /**
     * @param CarRepositoryInterface $carRepository
     */
    public function __construct(CarRepositoryInterface $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    /**
     * @return bool|false
     */
    public function fetchAutomobiles()
    {
        ini_set('memory_limit', '2048M');

        try {

            $client = Http::timeout(60)->get(self::API_URL . '/automobile.json');
            $cars = json_decode($client, true);

            foreach ($cars['RECORDS'] as $car) {
                $this->carRepository->updateOrCreate($car);
            }

        } catch (\Exception $e) {
            return false;
        }
    }
}
