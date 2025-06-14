<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminPanelSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'com_code' => fake()->numberBetween(1, 5000) ,
            'company_name' => fake()->company(),
            'system_status' => fake()->randomElement([1, 2]),
            'mobile' => fake()->regexify('/^(012|015|010|011)[0-9]{8}$/'),
            'address' => fake()->address(),
            'email' => fake()->unique()->safeEmail(),
            'created_by' => 1,
            'updated_by' => 1,
            'after_minute_calculate_delay' => '15.00',
            'after_minute_calculate_early_departure' => '15.00',
            'after_minute_quarterday' => '30.00',
            'after_time_half_daycut' => '2.00',
            'after_time_allday_daycut' => '4.00',
            'monthly_vacation_balance' => '1.75',
            'after_days_begin_vacation' => '180',
            'first_balance_begin_vacation' => '10.50',
            'sanctions_value_first_absence' => '9.00',
            'sanctions_value_second_absence' => '10.00',
            'sanctions_value_thaird_absence' => '10.00',
            'sanctions_value_forth_absence' => '11.00',
        ];
    }
}