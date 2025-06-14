<?php

namespace Database\Factories;

use App\Faker\CountryFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $country = CountryFaker::uniqueCountry();

        return [
            'name' => $country['name'],
            'country_code' => $country['country_code'],
            'active' => 1,
            'com_code' => 6000,
            'created_by' => 1,
        ];
    }
}