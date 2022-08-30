<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

/**
 * Class BrandSeeder
 * @package Database\Seeders
 */
class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::factory(1)->create();
    }
}
