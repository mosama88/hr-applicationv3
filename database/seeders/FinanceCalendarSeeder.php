<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FinanceCalendarSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('finance_calendars')->insert([
            'id' => 1,
            'finance_yr' => '2025',
            'slug' => '2025',
            'finance_yr_desc' => 'السنه المالية لسنه 2025',
            'start_date' => '2025-01-01',
            'end_date' => '2025-12-31',
            'is_open' => 0,
            'com_code' => 6000,
            'created_by' => 1,
            'updated_by' => null,
            'created_at' => '2025-06-07 10:21:34',
            'updated_at' => '2025-06-07 10:21:34',
        ]);
    }
}
