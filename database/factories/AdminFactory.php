<?php

namespace Database\Factories;

use App\Enums\AdminGenderEnum;
use App\Enums\AdminStatusEnum;
use App\Models\AdminPanelSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'com_code' => AdminPanelSetting::all()->random()->com_code,
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'username' => fake()->unique()->userName(),
            'password' => 'password', // password
            'status' => fake()->randomElement([AdminStatusEnum::Active->value, AdminStatusEnum::Inactive->value]),
            'gender' => fake()->randomElement([AdminGenderEnum::Male->value, AdminGenderEnum::Female->value]),
        ];
    }
}