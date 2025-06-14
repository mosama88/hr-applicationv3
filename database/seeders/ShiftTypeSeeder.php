<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ShiftTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {
        DB::table('shifts_types')->insert([
            [
                'id' => 1,
                'type' => 1,
                'slug' => 'sbah',
                'from_time' => '08:00:00',
                'to_time' => '16:00:00',
                'total_hours' => 8.00,
                'active' => 1,
                'created_by' => 1,
                'updated_by' => null,
                'com_code' => 6000,
                'created_at' => Carbon::parse('2025-06-02 15:56:05'),
                'updated_at' => Carbon::parse('2025-06-02 15:56:05'),
            ],
            [
                'id' => 2,
                'type' => 2,
                'slug' => 'msay',
                'from_time' => '12:00:00',
                'to_time' => '20:00:00',
                'total_hours' => 8.00,
                'active' => 1,
                'created_by' => 1,
                'updated_by' => null,
                'com_code' => 6000,
                'created_at' => Carbon::parse('2025-06-02 15:56:33'),
                'updated_at' => Carbon::parse('2025-06-02 15:56:33'),
            ],
            [
                'id' => 3,
                'type' => 3,
                'slug' => 'yom-kaml',
                'from_time' => '12:00:00',
                'to_time' => '00:00:00',
                'total_hours' => 12.00,
                'active' => 1,
                'created_by' => 1,
                'updated_by' => null,
                'com_code' => 6000,
                'created_at' => Carbon::parse('2025-06-02 15:56:48'),
                'updated_at' => Carbon::parse('2025-06-02 15:56:48'),
            ],
        ]);
    }
}