<?php

namespace Database\Seeders;

use App\Models\Qualification;
use Illuminate\Database\Seeder;
use App\Faker\QualificationFaker;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();
        $qualificationFaker = new QualificationFaker($faker);
        for ($i = 0; $i < 50; $i++) {
            $qualification = $qualificationFaker->qualificationName();

            Qualification::updateOrCreate(
                ['name' => $qualification],
                [
                    'active' => 1,
                    'com_code' => 6000,
                    'created_by' => 1,
                ]
            );
        }
    }
}