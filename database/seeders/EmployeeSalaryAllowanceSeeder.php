<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployeeSalaryAllowance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeSalaryAllowanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmployeeSalaryAllowance::factory()->count(200)->Create();
    }
}