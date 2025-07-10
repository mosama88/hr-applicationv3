<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployeeSalaryDiscount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeSalaryDiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmployeeSalaryDiscount::factory()->count(200)->Create();
    }
}