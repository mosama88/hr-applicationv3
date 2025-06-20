<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FinanceClnPeriodsSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['id' => 1,  'month' => '01', 'days' => 31],
            ['id' => 2,  'month' => '02', 'days' => 28],
            ['id' => 3,  'month' => '03', 'days' => 31],
            ['id' => 4,  'month' => '04', 'days' => 30],
            ['id' => 5,  'month' => '05', 'days' => 31],
            ['id' => 6,  'month' => '06', 'days' => 30],
            ['id' => 7,  'month' => '07', 'days' => 31],
            ['id' => 8,  'month' => '08', 'days' => 31],
            ['id' => 9,  'month' => '09', 'days' => 30],
            ['id' => 10, 'month' => '10', 'days' => 31],
            ['id' => 11, 'month' => '11', 'days' => 30],
            ['id' => 12, 'month' => '12', 'days' => 31],
        ];

        $commonFields = [
            'finance_calendar_id' => 1,
            'finance_yr' => '2025',
            'is_open' => 1,
            'created_by' => 1,
            'updated_by' => null,
            'com_code' => 6000,
            'created_at' => '2025-06-07 10:21:34',
            'updated_at' => null,
        ];

        foreach ($data as $item) {
            $start = "2025-{$item['month']}-01";
            $end = date("Y-m-t", strtotime($start)); // last day of month

            DB::table('finance_cln_periods')->insert([
                'id' => $item['id'],
                'finance_calendar_id' => $commonFields['finance_calendar_id'],
                'finance_yr' => $commonFields['finance_yr'],
                'year_and_month' => "2025-{$item['month']}",
                'start_date_m' => $start,
                'end_date_m' => $end,
                'number_of_days' => $item['days'],
                'start_date_fp' => $start,
                'end_date_fp' => $end,
                'is_open' => $commonFields['is_open'],
                'created_by' => $commonFields['created_by'],
                'updated_by' => $commonFields['updated_by'],
                'com_code' => $commonFields['com_code'],
                'created_at' => $commonFields['created_at'],
                'updated_at' => $commonFields['updated_at'],
            ]);
        }
    }
}
