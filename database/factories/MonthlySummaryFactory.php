<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MonthlySummary>
 */
class MonthlySummaryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $months = [];
        for ($year = 2022; $year <= date('Y'); $year++) {
            for ($month = 1; $month <= 12; $month++) {
                $months[] = sprintf('%d-%02d', $year, $month); // YYYY-MM formátum
            }
        }


        return [
            'all_routes_length'=>$this->faker->numberBetween(0,4000000),
            'income'=>$this->faker->numberBetween(0,300000),
            'month'=>$this->faker->randomElement($months),
            'expenses'=>$this->faker->numberBetween(0,4000000)
        ];
    }
}
