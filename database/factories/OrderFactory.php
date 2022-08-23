<?php

namespace Database\Factories;

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
            'user_id' => $this->faker->numberBetween(1, 10000),
            'service_id' => $this->faker->numberBetween(1, 10000),
            'car_id' => $this->faker->numberBetween(1, 10000),
            'status' => 0,
            'price' => $this->faker->numberBetween(1, 10000)
        ];
    }
}
