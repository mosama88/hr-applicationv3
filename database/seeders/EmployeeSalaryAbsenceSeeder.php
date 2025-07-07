<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployeeSalaryAbsence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeSalaryAbsenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmployeeSalaryAbsence::factory()->count(200)->Create();
    }
}