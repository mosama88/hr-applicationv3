<?php

namespace Database\Seeders;

use App\Models\DiscountType;
use Illuminate\Database\Seeder;
use App\Faker\DiscountTypeFaker;
use App\Faker\AdditionalTypeFaker;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DiscountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();
        $discountTypesFaker = new DiscountTypeFaker($faker); // ✅ تمرير Faker

        for ($i = 0; $i < 49; $i++) {
            $discountTypes = $discountTypesFaker->uniqueDiscountTypesName();

            DiscountType::updateOrCreate(
                ['name' => $discountTypes],
                [
                    'active' => 1,
                    'com_code' => 6000,
                    'created_by' => 1,
                ]
            );
        }
    }
}