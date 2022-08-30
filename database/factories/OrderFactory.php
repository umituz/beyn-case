<?php

namespace Database\Factories;

use App\Enums\OrderEnums;
use App\Models\Car;
use App\Models\Service;
use App\Models\User;
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
            'user_id' => User::factory(),
            'service_id' => Service::factory(),
            'car_id' => Car::factory(),
            'status' => 0,
            'price' => $this->faker->numberBetween(1, 999)
        ];
    }
}
