<?php

namespace App\Http\Controllers\Dashboard\Salaries;

use Illuminate\Http\Request;
use App\Models\FinanceCalendar;
use App\Models\FinanceClnPeriod;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Enums\FinanceClnPeriodsIsOpen;
use App\Http\Requests\Dashboard\Settings\FinanceClnPeriodRequest;

class MainSalaryRecordController extends Controller
{
    public function index(FinanceCalendar $financeCalendar)
    {
        try {
            $com_code = Auth::user()->com_code;
            $financeClnPeriod = FinanceClnPeriod::where('is_open', ">", 0)->first();
            if (!$financeClnPeriod) {
                return redirect()
                    ->back()
                    ->withErrors(['error' => 'عفوآ ! . لا يوجد سنه مالية مفتوحه']);
            }
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

    public function createOpen(FinanceClnPeriod $financeClnPeriod)
    {
        return view('dashboard.salaries.main_salary_records.open-month', compact('financeClnPeriod'));
    }

    public function openMonth(Request $request, $id)
    {
        try {
            $com_code = Auth::user()->com_code;

            $request->validate([
                'start_date_fp' => 'required|date',
                'end_date_fp' => 'required|date|after:start_date_fp',
            ], [
                'start_date_fp.required' => 'تاريخ بداية البصمة مطلوب',
                'start_date_fp.date' => 'يجب أن يكون تاريخ بداية البصمة تاريخًا صحيحًا',
                'end_date_fp.required' => 'تاريخ نهاية البصمة مطلوب',
                'end_date_fp.date' => 'يجب أن يكون تاريخ نهاية البصمة تاريخًا صحيحًا',
                'end_date_fp.after' => 'يجب أن يكون تاريخ نهاية البصمة بعد تاريخ البداية.',
            ]);

            // تأكيد وجود السجل
            FinanceClnPeriod::findOrFail($id);

            $dataToUpdate = [
                'start_date_fp' => $request->start_date_fp,
                'end_date_fp' => $request->end_date_fp,
                'is_open' => FinanceClnPeriodsIsOpen::Open,
                'updated_by' => Auth::user()->id,
                'com_code' => $com_code,
            ];

            FinanceClnPeriod::where('com_code', $com_code)
                ->where('id', $id)
                ->update($dataToUpdate);

            return redirect()->route('dashboard.main_salary_records.index')->with('success', 'تم فتح الشهر المالى بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function editOpen(FinanceClnPeriod $financeClnPeriod)
    {
        return view('dashboard.salaries.main_salary_records.edit-month', compact('financeClnPeriod'));
    }

    public function editMonth(Request $request, $id)
    {
        try {
            $com_code = Auth::user()->com_code;

            $request->validate([
                'start_date_fp' => 'required|date',
                'end_date_fp' => 'required|date|after:start_date_fp',
            ], [
                'start_date_fp.required' => 'تاريخ بداية البصمة مطلوب',
                'start_date_fp.date' => 'يجب أن يكون تاريخ بداية البصمة تاريخًا صحيحًا',
                'end_date_fp.required' => 'تاريخ نهاية البصمة مطلوب',
                'end_date_fp.date' => 'يجب أن يكون تاريخ نهاية البصمة تاريخًا صحيحًا',
                'end_date_fp.after' => 'يجب أن يكون تاريخ نهاية البصمة بعد تاريخ البداية.',
            ]);

            // تأكيد وجود السجل
            FinanceClnPeriod::findOrFail($id);

            $dataToUpdate = [
                'start_date_fp' => $request->start_date_fp,
                'end_date_fp' => $request->end_date_fp,
                'is_open' => FinanceClnPeriodsIsOpen::Open,
                'updated_by' => Auth::user()->id,
                'com_code' => $com_code,
            ];

            FinanceClnPeriod::where('com_code', $com_code)
                ->where('id', $id)
                ->update($dataToUpdate);

            return redirect()->route('dashboard.main_salary_records.index')->with('success', 'تم تعديل الشهر المالى بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function closeMonth($id)
    {
        try {
            $com_code = Auth::user()->com_code;

            // تأكيد وجود السجل
            FinanceClnPeriod::findOrFail($id);

            $dataToUpdate = [
                'is_open' => FinanceClnPeriodsIsOpen::Archived,
                'updated_by' => Auth::user()->id,
                'com_code' => $com_code,
            ];

            FinanceClnPeriod::where('com_code', $com_code)
                ->where('id', $id)
                ->update($dataToUpdate);

            return redirect()->route('dashboard.main_salary_records.index')->with('success', 'تم غلق الشهر المالى بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }
}