<?php

namespace App\Observers;

use DateTime;
use DatePeriod;
use DateInterval;
use App\Models\FinanceCalendar;
use App\Models\FinanceClnPeriod;
use Illuminate\Support\Facades\Auth;

class FinanceCalendarObserver
{
    /**
     * Handle the FinanceCalendar "created" event.
     */
    public function created(FinanceCalendar $financeCalendar): void
    {
        $com_code = Auth::user()->com_code;
        if ($financeCalendar) {
            $startDate = new DateTime($financeCalendar->start_date);
            $endDate = new DateTime($financeCalendar->end_date);
            $endDate->modify('first day of next month'); // To include the end date month in the period
            $dateInterval = new DateInterval('P1M'); // P1M = Period of 1 Month
            $datePeriod = new DatePeriod($startDate, $dateInterval, $endDate);

            foreach ($datePeriod as $date) {
                $dataMonth = [];
                $dataMonth['finance_calendar_id'] = $financeCalendar->id;
                $dataMonth['finance_yr'] = $financeCalendar->finance_yr;
                $dataMonth['start_date_m'] = $date->format('Y-m-01');
                $dataMonth['end_date_m'] = $date->format('Y-m-t');
                $dataMonth['year_and_month'] = $date->format('Y-m');
                $CalcnumOfDays = strtotime($dataMonth['end_date_m']) - strtotime($dataMonth['start_date_m']);
                $dataMonth['number_of_days'] = round($CalcnumOfDays / (60 * 60 * 24)) + 1;
                $dataMonth['start_date_fp'] = $dataMonth['start_date_m'];
                $dataMonth['end_date_fp'] = $dataMonth['end_date_m'];
                $dataMonth['com_code'] = $com_code;
                $dataMonth['created_at'] = now();
                $dataMonth['created_by'] = Auth::user()->id;

                FinanceClnPeriod::create($dataMonth);
            }
        }
    }

    /**
     * Handle the FinanceCalendar "updated" event.
     */
    public function updated(FinanceCalendar $financeCalendar): void
    {
        // تحقق هل تغيرت تواريخ البداية أو النهاية
        if (
            $financeCalendar->getOriginal('start_date') != $financeCalendar->start_date
            || $financeCalendar->getOriginal('end_date') != $financeCalendar->end_date
        ) {
            // حذف الشهور القديمة المرتبطة بهذه السنة المالية
            FinanceClnPeriod::where('finance_calendar_id', $financeCalendar->id)->delete();

            // إنشاء الشهور الجديدة بناءً على التاريخ الجديد
            $startDate = new DateTime($financeCalendar->start_date);
            $endDate = new DateTime($financeCalendar->end_date);
            $endDate->modify('first day of next month'); // لضمان شمول آخر شهر

            $dateInterval = new DateInterval('P1M');
            $datePeriod = new DatePeriod($startDate, $dateInterval, $endDate);

            foreach ($datePeriod as $dateUpdate) {
                FinanceClnPeriod::create([
                    'finance_calendar_id' => $financeCalendar->id,
                    'finance_yr' => $financeCalendar->finance_yr,
                    'year_and_month' => $dateUpdate->format('Y-m'),
                    'start_date_m' => $dateUpdate->format('Y-m-01'),
                    'end_date_m' => $dateUpdate->format('Y-m-t'),
                    'number_of_days' => (int)$dateUpdate->format('t'),
                    'start_date_fp' => $dateUpdate->format('Y-m-01'),
                    'end_date_fp' => $dateUpdate->format('Y-m-t'),
                    'com_code' => $financeCalendar->com_code,
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                ]);
            }
        }
    }



    /**
     * Handle the FinanceCalendar "deleted" event.
     */
    public function deleted(FinanceCalendar $financeCalendar): void
    {

        //
    }

    /**
     * Handle the FinanceCalendar "restored" event.
     */
    public function restored(FinanceCalendar $financeCalendar): void
    {
        //
    }

    /**
     * Handle the FinanceCalendar "force deleted" event.
     */
    public function forceDeleted(FinanceCalendar $financeCalendar): void
    {
        //
    }
}