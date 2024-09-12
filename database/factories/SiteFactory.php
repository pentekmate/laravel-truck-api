<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Site>
 */
class SiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        $openHour = '0'. rand(7,9) . ':00';
        // $openDateTime = date('Y-m-d') . ' ' . $openHour;
        $openTimeTimestamp = strtotime($openHour);


        $closeTimeTimestamp = $openTimeTimestamp + 8 * 3600; 
        $closeTime = date('H:i:s', $closeTimeTimestamp);

        return [
            'address' => $this->faker->address(),
            'name' => $this->faker->unique()->company(),
            'phone_number' => $this->faker->unique()->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(), // Ensure unique email
            'open_time' => $openHour,
            'close_time' => $closeTime,
            'capacity' => $this->faker->numberBetween(0, 100),
            'manager_name' => $this->faker->name()
        ];
    }
}
