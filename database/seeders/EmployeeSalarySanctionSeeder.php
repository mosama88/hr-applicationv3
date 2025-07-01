<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployeeSalarySanction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeSalarySanctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmployeeSalarySanction::factory()->count(200)->Create();
    }
}
