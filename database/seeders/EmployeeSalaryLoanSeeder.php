<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployeeSalaryLoan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeSalaryLoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmployeeSalaryLoan::factory()->count(200)->Create();
    }
}