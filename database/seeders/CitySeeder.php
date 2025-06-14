<?php

namespace Database\Seeders;

use App\Models\City;
use App\Faker\CityFaker;
use App\Models\Governorate;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{



    /**
     * Run the database seeds.
     */
  public function run(): void
    {
        $faker = FakerFactory::create();
        $cityFaker = new CityFaker($faker);

        for ($i = 0; $i < 500; $i++) {
            $cityData = $cityFaker->uniqueCity();

            // Find the governorate by name
            $governorate = Governorate::where('name', $cityData['governorate_id'])->first();

            if ($governorate) {
                City::updateOrCreate(
                    ['name' => $cityData['name']],
                    [
                        'governorate_id' => $governorate->id,
                        'active' => 1,
                        'com_code' => 6000,
                        'created_by' => 1,
                    ]
                );
            }
        }
    }
}