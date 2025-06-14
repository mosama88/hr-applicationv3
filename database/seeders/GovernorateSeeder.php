<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Governorate;
use App\Faker\GovernorateFaker;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();
        $governorateFaker = new GovernorateFaker($faker);

        for ($i = 0; $i < 500; $i++) {
            $governorateData = $governorateFaker->uniqueGovernorate();

            // Find the governorate by name
            $country = Country::where('name', $governorateData['country_id'])->first();

            if ($country) {
                Governorate::updateOrCreate(
                    ['name' => $governorateData['name']],
                    [
                        'country_id' => $country->id,
                        'active' => 1,
                        'com_code' => 6000,
                        'created_by' => 1,
                    ]
                );
            }
        }
    }
}