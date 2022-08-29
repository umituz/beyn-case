<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

/**
 * Class OrderSeeder
 * @package Database\Seeders
 */
class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::factory(10)->hasCar()->hasService()->hasUser()->times(10)->create();
    }
}
