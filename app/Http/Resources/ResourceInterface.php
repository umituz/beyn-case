<?php

namespace App\Http\Resources;

/**
 * Interface StatisticsResourceInterface
 * @package App\Http\Resources
 */
interface ResourceInterface
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array;
}
