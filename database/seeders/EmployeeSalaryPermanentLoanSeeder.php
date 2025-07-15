<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployeeSalaryPermanentLoan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeSalaryPermanentLoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmployeeSalaryPermanentLoan::factory()->count(200)->Create();
    }
}