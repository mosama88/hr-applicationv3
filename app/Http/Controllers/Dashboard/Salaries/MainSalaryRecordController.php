<?php

namespace App\Http\Controllers\Dashboard\Salaries;

use App\Models\Employee;
use App\Enums\YesOrNoEnum;
use Illuminate\Http\Request;
use App\Enums\IsArchivedEnum;
use App\Models\FinanceCalendar;
use App\Models\FinanceClnPeriod;
use App\Enums\IsStoppedSalaryEnum;
use App\Models\MainSalaryEmployee;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Enums\FinanceCalendarsIsOpen;
use App\Enums\FinanceClnPeriodsIsOpen;
use App\Enums\Employee\FunctionalStatus;
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
            $dataFinanceClnPeriod = FinanceClnPeriod::where('id', $id)->where('com_code', $com_code)->findOrFail($id);
            if (!$dataFinanceClnPeriod) {
                return redirect()->back()->withErrors(['error' => 'غير قادر على الوصول للبيانات المطلوبة']);
            }

            $currentYear = FinanceCalendar::select('is_open')->where('com_code', $com_code)->where('finance_yr', $dataFinanceClnPeriod->finance_yr)->first();
            if (!$currentYear) {
                return redirect()->back()->withErrors(['error' => 'غير قادر على الوصول بيانات السنة المالية المطلوبة']);
            }
            if ($currentYear->is_open != FinanceCalendarsIsOpen::Open) {
                return redirect()->back()->withErrors(['error' => 'عفوا، السنة المالية التابعة لهذا الشهر غير مفتوحة!']);
            }


            if ($dataFinanceClnPeriod['is_open'] == FinanceClnPeriodsIsOpen::Open && $request->input('is_open') != FinanceClnPeriodsIsOpen::Archived) {
                // إذا كان الشهر مفتوحًا، ولكن يتم طلب تغييره إلى حالة أخرى (غير الأرشفة)، إظهار رسالة الخطأ
                return redirect()->back()->withErrors(['error' => 'عفوا، هذا الشهر مفتوح حاليا!']);
            }

            if ($dataFinanceClnPeriod['is_open'] == FinanceClnPeriodsIsOpen::Archived) {
                return redirect()->back()->withErrors(['error' => 'عفوا، هذا الشهر مؤرشف بالفعل!']);
            }

            $dataToUpdate = [
                'start_date_fp' => $request->start_date_fp,
                'end_date_fp' => $request->end_date_fp,
                'is_open' => FinanceClnPeriodsIsOpen::Open,
                'updated_by' => Auth::user()->id,
                'com_code' => $com_code,
            ];

            $flag =  FinanceClnPeriod::where('com_code', $com_code)
                ->where('id', $id)
                ->update($dataToUpdate);

            if ($flag) {
                $getEmployee = Employee::orderBy('employee_code', 'ASC')->where('com_code', $com_code)->where('functional_status', FunctionalStatus::Employee)->get();
                if ($getEmployee) {
                    foreach ($getEmployee as $info) {
                        $dataSalaryToInsert = [];
                        $dataSalaryToInsert['finance_cln_period_id'] = $id;
                        $dataSalaryToInsert['employee_code'] = $info->employee_code;
                        $dataSalaryToInsert['com_code'] = $com_code;
                        $checkExistsCounter = MainSalaryEmployee::where([
                            'finance_cln_period_id' => $id,
                            'employee_code' => $info->employee_code,
                            'com_code' => $com_code
                        ])->count();
                        if ($checkExistsCounter == 0) {
                            $dataSalaryToInsert['employee_name'] = $info->name;
                            $dataSalaryToInsert['day_price'] = $info->day_price;
                            $dataSalaryToInsert['is_sensitive_manager_data'] = YesOrNoEnum::Yes;
                            $dataSalaryToInsert['branch_id'] = $info->branch_id;
                            $dataSalaryToInsert['functional_status'] = $info->functional_status;
                            $dataSalaryToInsert['department_code'] = $info->department_id;
                            $dataSalaryToInsert['job_category_id'] = $info->job_category_id;
                            $lastSalaryData = MainSalaryEmployee::orderByDesc('id')
                                ->select('net_salary_after_close_for_deportation')
                                ->where('com_code', $com_code)
                                ->where('employee_code', $info->employee_code)
                                ->where('is_archived', IsArchivedEnum::Yes)
                                ->first(); // ✅ رجع سجل واحد وليس مجموعة

                            if ($lastSalaryData) {
                                $dataSalaryToInsert['last_salary_remain_balance'] = $lastSalaryData->net_salary_after_close_for_deportation;
                            } else {
                                $dataSalaryToInsert['last_salary_remain_balance'] = 0;
                            }

                            $dataSalaryToInsert['salary'] = $info->salary;
                            $dataSalaryToInsert['financial_year'] = $dataFinanceClnPeriod['finance_yr'];
                            $dataSalaryToInsert['year_month'] = $dataFinanceClnPeriod['year_and_month'];
                            $dataSalaryToInsert['type_salary_receipt'] = $info->type_salary_receipt;
                            $dataSalaryToInsert['created_by'] = Auth::user()->id;

                            MainSalaryEmployee::create($dataSalaryToInsert);
                        }
                    }
                }
            }

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
            $userId= Auth::user()->id;
            $com_code = Auth::user()->com_code;


            $dataFinanceClnPeriod = FinanceClnPeriod::where('id', $id)->where('com_code', $com_code)->findOrFail($id);
            if (!$dataFinanceClnPeriod) {
                return redirect()->back()->withErrors(['error' => 'غير قادر على الوصول للبيانات المطلوبة']);
            }

            $currentYear = FinanceCalendar::select('is_open')->where('com_code', $com_code)->where('finance_yr', $dataFinanceClnPeriod->finance_yr)->first();
            if (!$currentYear) {
                return redirect()->back()->withErrors(['error' => 'غير قادر على الوصول بيانات السنة المالية المطلوبة']);
            }
            // التأكد من حالة الشهر (في انتظار الفتح)
            if ($dataFinanceClnPeriod->is_open == FinanceClnPeriodsIsOpen::Pending) {
                return redirect()->back()->withErrors(['error' => 'عفوا، هذا الشهر بأنتظار الفتح!']);
            }

            if ($dataFinanceClnPeriod->is_open == FinanceClnPeriodsIsOpen::Archived) {
                return redirect()->back()->withErrors(['error' => 'عفوا، هذا الشهر مؤرشف بالفعل!']);
            }



            $dataToUpdate = [
                'is_open' => FinanceClnPeriodsIsOpen::Archived,
                'updated_by' =>$userId,
                'com_code' => $com_code,
            ];

            $flag =  FinanceClnPeriod::where('com_code', $com_code)->where('id', $id)->update($dataToUpdate);
            if ($flag) {
                $all_main_salary_employee = MainSalaryEmployee::orderBy('id', 'ASC')->where('com_code', $com_code)->where('finance_cln_period_id', $id)->get();
                if ($all_main_salary_employee) {
                    foreach ($all_main_salary_employee as $info) {
                        $dataUpdate['is_archived'] = IsArchivedEnum::Yes;
                        $dataUpdate['archived_date'] = now();
                        $dataUpdate['archived_by'] =$userId;
                        $dataUpdate['updated_by'] =$userId;
                        if ($info->net_salary < 0) {
                            $dataUpdate['net_salary_after_close_for_deportation'] = $info->net_salary;
                        } else {
                            $dataUpdate['net_salary_after_close_for_deportation'] = 0;
                        }
                        MainSalaryEmployee::where('com_code', $com_code)->where('finance_cln_period_id', $id)
                            ->where('is_stopped', IsStoppedSalaryEnum::Unstopped)->where('is_archived', IsArchivedEnum::No)->update($dataUpdate);
                    }
                }
            }

            return redirect()->route('dashboard.main_salary_records.index')->with('success', 'تم غلق الشهر المالى بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }
}