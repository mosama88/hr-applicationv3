<?php

namespace Database\Seeders;

use App\Models\AdditionalType;
use Illuminate\Database\Seeder;
use App\Faker\AdditionalTypeFaker;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdditionalTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();
        $additionalTypeFaker = new AdditionalTypeFaker($faker); // ✅ تمرير Faker

        for ($i = 0; $i < 49; $i++) {
            $additionalType = $additionalTypeFaker->uniqueAdditionalTypName();

            AdditionalType::updateOrCreate(
                ['name' => $additionalType],
                [
                    'active' => 1,
                    'com_code' => 6000,
                    'created_by' => 1,
                ]
            );
        }
    }
}
