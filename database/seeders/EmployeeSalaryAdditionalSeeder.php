<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployeeSalaryAdditional;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeSalaryAdditionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmployeeSalaryAdditional::factory()->count(200)->Create();
    }
}