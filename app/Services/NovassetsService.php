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
     * @return false|mixed
     */
    public function fetchAutomobiles(): mixed
    {
        ini_set('memory_limit', '2048M');

        try {
            $client = Http::timeout(60)->get(self::API_URL . '/automobile.json');

            return json_decode($client, true);
        } catch (\Exception $e) {
            return false;
        }
    }
}
