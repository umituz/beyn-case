<?php

namespace App\Services;

use App\Traits\NotifiableOnSlack;
use Illuminate\Support\Facades\Http;

/**
 * Class NovassetsService
 * @package App\Services
 */
class NovassetsService
{
    use NotifiableOnSlack;

    const API_URL = 'https://static.novassets.com';

    /**
     * @return false|mixed
     */
    public function fetchAutomobiles(): mixed
    {
        try {
            $client = Http::timeout(60)->get(self::API_URL . '/automobile.json');

            return json_decode($client, true);
        } catch (\Exception $e) {
            $this->toSlack(config('slack.channels.service_issues'), $e->getMessage());

            return false;
        }
    }
}
