<?php

namespace Database\Factories;

use App\Faker\CurrencyFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CurrencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $currency = CurrencyFaker::uniqueCurrency();

        return [
            'name' => $currency['name'],
            'currency_symbol' => $currency['currency_symbol'],
            'active' => 1,
            'com_code' => 6000,
            'created_by' => 1,
        ];
    }
}