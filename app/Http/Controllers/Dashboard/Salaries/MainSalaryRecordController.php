<?php

namespace App\Http\Controllers\Dashboard\Salaries;

use Illuminate\Http\Request;
use App\Models\FinanceCalendar;
use App\Models\FinanceClnPeriod;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Enums\FinanceClnPeriodsIsOpen;

class MainSalaryRecordController extends Controller
{
    public function index(FinanceCalendar $financeCalendar)
    {
        try {
            $com_code = Auth::user()->com_code;
            $data =  FinanceClnPeriod::select("*")->orderByDESC('finance_yr')->where('com_code', $com_code)->paginate(12);
            $countOpenMonth = FinanceClnPeriod::where('com_code', $com_code)->where('finance_yr', $financeCalendar->finance_yr)->where('is_open', FinanceClnPeriodsIsOpen::Open)->count();
            foreach ($data as $info) {
                // حساب عدد الأشهر المفتوحة لنفس السنة المالية
                $info->countOpenMonth = FinanceClnPeriod::where('com_code', $com_code)
                    ->where('finance_yr', $info->finance_yr)
                    ->where('is_open', FinanceClnPeriodsIsOpen::Open)
                    ->count();

                // حساب عدد الأشهر المنتظرة السابقة
                $info->counterPreviousWatingOpen = FinanceClnPeriod::where("com_code", $com_code)
                    ->where("finance_yr", $info->finance_yr)
                    ->where("start_date_m", "<", $info->start_date_m)
                    ->where("is_open", FinanceClnPeriodsIsOpen::Pending)
                    ->count();
            }
            return view('dashboard.salaries.main_salary_records.index', compact('data', 'countOpenMonth'));
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }




    public function openMonth(Request $request, FinanceClnPeriod $financeClnPeriod)
    {
        try {
            $com_code = Auth::user()->com_code;
            $financeClnPeriod->start_date_fp = $request->start_date_fp;
            $financeClnPeriod->end_date_fp = $request->end_date_fp;
            $financeClnPeriod->is_open = FinanceClnPeriodsIsOpen::Open;
            $financeClnPeriod->updated_by  = Auth::user()->id;
            $financeClnPeriod->com_code  = $com_code;

            $financeClnPeriod->update();
            return redirect()->back()->with('success', 'تم فتح الشهر المالى بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }
}
