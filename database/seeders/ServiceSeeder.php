<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

/**
 * Class ServiceSeeder
 * @package Database\Seeders
 */
class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::factory(1)->create();
    }
}
