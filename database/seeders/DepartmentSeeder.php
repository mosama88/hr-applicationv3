<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Faker\DepartmentFaker;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = FakerFactory::create();
        $departmentFaker = new DepartmentFaker($faker); // ✅ تمرير Faker

        for ($i = 0; $i < 40; $i++) {
            $department = $departmentFaker->uniqueDepartmentName();

            Department::updateOrCreate(
                ['name' => $department],
                [
                    'phones' => fake()->regexify('/^(012|015|010|011)[0-9]{8}$/'),
                    'notes' => fake()->paragraph(),
                    'active' => 1,
                    'com_code' => 6000,
                    'created_by' => 1,
                ]
            );
        }
    }
}