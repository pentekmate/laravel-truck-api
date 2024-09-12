<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TruckFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'license_plate'=>fake()->buildingNumber(),
            'color'=>fake()->colorName(),
            'engine_power'=>fake()->numberBetween(200,600),
            'weight'=>fake()->numberBetween(8000,16000),
            'mileage'=>fake()->numberBetween(0,3000000),
            'driver_name'=>fake()->unique()->name()
        ];
    }
}
