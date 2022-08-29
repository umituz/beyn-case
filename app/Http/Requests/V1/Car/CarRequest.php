<?php

namespace App\Http\Requests\V1\Car;

use App\Http\Requests\Request;

/**
 * Class CarRequest
 * @package App\Http\Requests
 */
class CarRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'url' => ['required', 'string', 'max:191'],
            'brand' => ['required', 'string', 'max:191'],
            'engine_cylinders' => ['nullable', 'string', 'max:191'],
            'engine_displacement' => ['nullable', 'string', 'max:191'],
            'engine_power' => ['nullable', 'string', 'max:191'],
            'engine_torque' => ['nullable', 'string', 'max:191'],
            'engine_fuel_system' => ['nullable', 'string', 'max:191'],
            'engine_fuel' => ['nullable', 'string', 'max:191'],
            'engine_c2o' => ['nullable', 'string', 'max:191'],
            'performance_top_speed' => ['nullable', 'string', 'max:191'],
            'performance_acceleration' => ['nullable', 'string', 'max:191'],
            'fuel_economy_city' => ['nullable', 'string', 'max:191'],
            'fuel_economy_highway' => ['nullable', 'string', 'max:191'],
            'fuel_economy_combined' => ['nullable', 'string', 'max:191'],
            'transmission_drive_type' => ['nullable', 'string', 'max:191'],
            'transmission_gearbox' => ['nullable', 'string', 'max:191'],
            'brakes_front' => ['nullable', 'string', 'max:191'],
            'brakes_rear' => ['nullable', 'string', 'max:191'],
            'tires_size' => ['nullable', 'string', 'max:191'],
            'dimensions_length' => ['nullable', 'string', 'max:191'],
            'dimensions_width' => ['nullable', 'string', 'max:191'],
            'dimensions_height' => ['nullable', 'string', 'max:191'],
            'dimensions_front_rear_track' => ['nullable', 'string', 'max:191'],
            'dimensions_wheelbase' => ['nullable', 'string', 'max:191'],
            'dimensions_ground_clearance' => ['nullable', 'string', 'max:191'],
            'dimensions_cargo_volume' => ['nullable', 'string', 'max:191'],
            'dimensions_cd' => ['nullable', 'string', 'max:191'],
            'weight_unladen' => ['nullable', 'string', 'max:191'],
            'weight_limit' => ['nullable', 'string', 'max:191'],
        ];
    }
}
