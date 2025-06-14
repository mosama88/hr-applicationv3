<?php

namespace Database\Seeders;

use App\Models\JobCategory;
use App\Faker\JobCategoryFaker;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();
        $jobCategoryFaker = new JobCategoryFaker($faker); // ✅ تمرير Faker

        for ($i = 0; $i < 95; $i++) {
            $jobCategory = $jobCategoryFaker->uniquejobCategoryName();

            JobCategory::updateOrCreate(
                ['name' => $jobCategory],
                [
                    'active' => 1,
                    'com_code' => 6000,
                    'created_by' => 1,
                ]
            );
        }
    }
}