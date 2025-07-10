<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployeeSalaryReward;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeSalaryRewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmployeeSalaryReward::factory()->count(200)->Create();
    }
}