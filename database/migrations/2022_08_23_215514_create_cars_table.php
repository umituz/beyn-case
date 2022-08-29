<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id');
            $table->string('option', 191)->nullable();
            $table->string('engine_cylinders', 191)->nullable();
            $table->string('engine_displacement', 191)->nullable();
            $table->string('engine_power', 191)->nullable();
            $table->string('engine_torque', 191)->nullable();
            $table->string('engine_fuel_system', 191)->nullable();
            $table->string('engine_fuel', 191)->nullable();
            $table->string('engine_c2o', 191)->nullable();
            $table->string('performance_top_speed', 191)->nullable();
            $table->string('performance_acceleration', 191)->nullable();
            $table->string('fuel_economy_city', 191)->nullable();
            $table->string('fuel_economy_highway', 191)->nullable();
            $table->string('fuel_economy_combined', 191)->nullable();
            $table->string('transmission_drive_type', 191)->nullable();
            $table->string('transmission_gearbox', 191)->nullable();
            $table->string('brakes_front', 191)->nullable();
            $table->string('brakes_rear', 191)->nullable();
            $table->string('tires_size', 191)->nullable();
            $table->string('dimensions_length', 191)->nullable();
            $table->string('dimensions_width', 191)->nullable();
            $table->string('dimensions_height', 191)->nullable();
            $table->string('dimensions_front_rear_track', 191)->nullable();
            $table->string('dimensions_wheelbase', 191)->nullable();
            $table->string('dimensions_ground_clearance', 191)->nullable();
            $table->string('dimensions_cargo_volume', 191)->nullable();
            $table->string('dimensions_cd', 191)->nullable();
            $table->string('weight_unladen', 191)->nullable();
            $table->string('weight_limit', 191)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
};
