<?php

namespace Database\Seeders;

use App\Models\Nationality;
use Illuminate\Database\Seeder;
use App\Faker\NationalityFaker;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();
        $nationalityFaker = new NationalityFaker($faker); // ✅ تمرير Faker

        for ($i = 0; $i < 99; $i++) {
            $nationality = $nationalityFaker->uniqueNationalityName();

            Nationality::updateOrCreate(
                ['name' => $nationality],
                [
                    'active' => 1,
                    'com_code' => 6000,
                    'created_by' => 1,
                ]
            );
        }
    }
}