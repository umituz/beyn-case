<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'url' => $this->faker->word,
            'brand' => $this->faker->word,
            'model' => $this->faker->word,
            'year' => $this->faker->word,
            'option' => $this->faker->word,
            'engine_cylinders' => $this->faker->word,
            'engine_displacement' => $this->faker->word,
            'engine_power' => $this->faker->word,
            'engine_torque' => $this->faker->word,
            'engine_fuel_system' => $this->faker->word,
            'engine_fuel' => $this->faker->word,
            'engine_c2o' => $this->faker->word,
            'performance_top_speed' => $this->faker->word,
            'performance_acceleration' => $this->faker->word,
            'fuel_economy_city' => $this->faker->word,
            'fuel_economy_highway' => $this->faker->word,
            'fuel_economy_combined' => $this->faker->word,
            'transmission_drive_type' => $this->faker->word,
            'transmission_gearbox' => $this->faker->word,
            'brakes_front' => $this->faker->word,
            'brakes_rear' => $this->faker->word,
            'tires_size' => $this->faker->word,
            'dimensions_length' => $this->faker->word,
            'dimensions_width' => $this->faker->word,
            'dimensions_height' => $this->faker->word,
            'dimensions_front_rear_track' => $this->faker->word,
            'dimensions_wheelbase' => $this->faker->word,
            'dimensions_ground_clearance' => $this->faker->word,
            'dimensions_cargo_volume' => $this->faker->word,
            'dimensions_cd' => $this->faker->word,
            'weight_unladen' => $this->faker->word,
            'weight_limit' => $this->faker->word
        ];
    }
}
