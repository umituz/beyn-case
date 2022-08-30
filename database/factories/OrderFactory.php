<?php

namespace Database\Factories;

use App\Enums\OrderEnums;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'barcode' => OrderEnums::PREFIX . trim(microtime()),
            'user_id' => $this->faker->numberBetween(1, 10),
            'service_id' => $this->faker->numberBetween(1, 10),
            'car_id' => $this->faker->numberBetween(1, 10),
            'status' => 0,
            'price' => $this->faker->numberBetween(1, 10)
        ];
    }
}
