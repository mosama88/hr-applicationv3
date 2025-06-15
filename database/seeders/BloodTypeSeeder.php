<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BloodTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bloodTypes = [
            'A+',
            'A-',
            'B+',
            'B-',
            'AB+',
            'AB-',
            'O+',
            'O-',
        ];

        foreach ($bloodTypes as $type) {
            DB::table('blood_types')->insert([
                'name' => $type,
                'slug' => strtolower($type), // Convert to lowercase for consistency
                'active' => 1,
                'com_code' => 6000,
                'created_by' => 1,
            ]);
        }
    }
}