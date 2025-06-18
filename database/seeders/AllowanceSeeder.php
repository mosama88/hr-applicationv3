<?php

namespace Database\Seeders;

use App\Models\Allowance;
use App\Faker\AllowanceFaker;
use Illuminate\Database\Seeder;
use App\Faker\AdditionalTypeFaker;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AllowanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();
        $AllowanceFaker = new AllowanceFaker($faker); // ✅ تمرير Faker

        for ($i = 0; $i < 49; $i++) {
            $allowance = $AllowanceFaker->uniqueAllowancesName();

            Allowance::updateOrCreate(
                ['name' => $allowance],
                [
                    'active' => 1,
                    'com_code' => 6000,
                    'created_by' => 1,
                ]
            );
        }
    }
}