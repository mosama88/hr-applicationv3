<?php

namespace App\Http\Controllers\Dashboard\Salaries;

use App\Models\Allowance;
use Illuminate\Http\Request;
use App\Enums\IsArchivedEnum;
use App\Enums\StatusActiveEnum;
use App\Models\FinanceClnPeriod;
use App\Models\MainSalaryEmployee;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Enums\FinanceClnPeriodsIsOpen;
use App\Models\EmployeeSalaryAllowance;
use App\Exports\EmployeeSalaryAllowanceExport;
use App\Imports\EmployeeSalaryAllowanceImport;
use App\Http\Requests\Dashboard\Salaries\EmployeeSalaryAllowanceRequest;

class EmployeeSalaryAllowanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $com_code = Auth::user()->com_code;
            $financeClnPeriod = FinanceClnPeriod::where('is_open', ">", 0)->first();
            if (!$financeClnPeriod) {
                return redirect()
                    ->back()
                    ->withErrors(['error' => 'عفوآ ! . لا يوجد سنه مالية مفتوحه']);
            }
            $data = FinanceClnPeriod::select('*')->where('com_code', $com_code)
                ->orderBy('finance_yr', 'DESC')
                ->orderBy('start_date_m', 'ASC')->paginate(12);
            if ($data) {
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
            }
            return view('dashboard.salaries.employee_salary_allowances.index', compact('data'));
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(FinanceClnPeriod $financeClnPeriod)
    {
        try {
            $com_code = Auth::user()->com_code;

            $other['allowances'] = Allowance::where('com_code', $com_code)->where('active', StatusActiveEnum::ACTIVE)->get();
            return view('dashboard.salaries.employee_salary_allowances.create', compact('financeClnPeriod', 'other'));
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeSalaryAllowanceRequest $request, $financeClnPeriodId)
    {
        try {
            $com_code = Auth::user()->com_code;
            $userId = Auth::user()->id;
            $financeClnPeriod = FinanceClnPeriod::where('com_code', $com_code)
                ->where('id', $financeClnPeriodId)
                ->firstOrFail();
            if ($financeClnPeriod->is_open != FinanceClnPeriodsIsOpen::Open) {
                return redirect()->route('dashboard.employee_salary_allowances.show', $financeClnPeriod->slug)->withErrors(['error' => 'عفوا الشهر المالى غير مفتوح !'])->withInput();
            }

            $validateData = $request->validated();
            $dataInsert = array_merge($validateData, [
                'finance_cln_period_id' => $financeClnPeriod->id,
                'main_salary_employee_id' => $request->main_salary_employee_id,
                'is_archived' => IsArchivedEnum::Unarchived,
                'com_code' => $com_code,
                'created_by' => $userId,
            ]);
            EmployeeSalaryAllowance::create($dataInsert);
            return redirect()->route('dashboard.employee_salary_allowances.show', $financeClnPeriod->slug)->with('success', 'تم أضاف البدلات المتغيرة بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.employee_salary_allowances.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(FinanceClnPeriod $financeClnPeriod)
    {
        try {
            $com_code = Auth::user()->com_code;
            $finance_cln_periods_data = FinanceClnPeriod::where('com_code', $com_code)->where('id', $financeClnPeriod->id)->get();
            if (!$finance_cln_periods_data) {
                return redirect()->back()->withErrors(['error' => 'عفوا غير قادر للوصول على البيانات المطلوبه !'])->withInput();
            }

            $data = EmployeeSalaryAllowance::with([
                'mainSalaryEmployee' => function ($q) {
                    $q->select(['id', 'employee_code', 'employee_name', 'department_code', 'branch_id']);
                },
                'mainSalaryEmployee.employee' => function ($q) {
                    $q->select(['id', 'employee_code', 'name', 'gender'])->with('media');
                }
            ])->filter(request()->all())
                ->orderBy('id', 'DESC')
                ->where('com_code', $com_code)
                ->where('finance_cln_period_id', $financeClnPeriod->id)
                ->paginate(5);


            return view('dashboard.salaries.employee_salary_allowances.show', compact('financeClnPeriod', 'data'));
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.employee_salary_allowances.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function showData(EmployeeSalaryAllowance $employeeSalaryAllowance, FinanceClnPeriod $financeClnPeriod)
    {
        try {
            $com_code = Auth::user()->com_code;
            $other['allowances'] = Allowance::where('com_code', $com_code)->where('active', StatusActiveEnum::ACTIVE)->get();
            return view('dashboard.salaries.employee_salary_allowances.show_data', compact('employeeSalaryAllowance', 'financeClnPeriod', 'other'));
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.employee_salary_allowances.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit(EmployeeSalaryAllowance $employeeSalaryAllowance, FinanceClnPeriod $financeClnPeriod)
    {
        try {
            $com_code = Auth::user()->com_code;
            $other['allowances'] = Allowance::where('com_code', $com_code)->where('active', StatusActiveEnum::ACTIVE)->get();
            return view('dashboard.salaries.employee_salary_allowances.edit', compact('employeeSalaryAllowance', 'financeClnPeriod', 'other'));
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.employee_salary_allowances.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeSalaryAllowanceRequest $request, EmployeeSalaryAllowance $employeeSalaryAllowance)
    {
        try {
            $com_code = Auth::user()->com_code;
            $userId = Auth::user()->id;
            $financeClnPeriod = FinanceClnPeriod::where('com_code', $com_code)
                ->where('id', $employeeSalaryAllowance->finance_cln_period_id)
                ->firstOrFail();
            if ($financeClnPeriod->is_open != FinanceClnPeriodsIsOpen::Open) {
                return redirect()->route('dashboard.employee_salary_allowances.show', $financeClnPeriod->slug)->withErrors(['error' => 'عفوا الشهر المالى غير مفتوح !'])->withInput();
            }
            $validated = $request->validated();
            $employeeSalaryAllowance->update([
                'finance_cln_period_id' => $financeClnPeriod->id,
                'main_salary_employee_id' => $validated['main_salary_employee_id'],
                'employee_code' => $validated['employee_code'],
                'day_price' => $validated['day_price'],
                'allowance_id' => $validated['allowance_id'],
                'total' => $validated['total'],
                'notes' => $validated['notes'] ?? null,
                'is_archived' => IsArchivedEnum::Unarchived,
                'updated_by' => $userId,
                'com_code' => $com_code,
            ]);

            return redirect()->route('dashboard.employee_salary_allowances.show', $financeClnPeriod->slug)->with('success', 'تم تعديل البدلات المتغيرة بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.employee_salary_allowances.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeSalaryAllowance $employeeSalaryAllowance, FinanceClnPeriod $financeClnPeriod)
    {
        try {
            $com_code = Auth::user()->com_code;

            $finance_cln_periods_data = FinanceClnPeriod::where('com_code', $com_code)->where('id', $financeClnPeriod->id)->get();
            if (!$finance_cln_periods_data) {
                return redirect()->back()->withErrors(['error' => 'عفوا غير قادر للوصول على البيانات المطلوبه !'])->withInput();
            }
            $employeeSalaryAllowance->delete();
            return response()->json([
                'success' => true,
                'message' => 'تم حذف البدلات المتغيرة بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء محاولة الحذف',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getDayPrice($id)
    {
        $employee = MainSalaryEmployee::find($id); // تأكد من استخدام النموذج الصحيح

        if ($employee) {
            return response()->json([
                'status' => true,
                'day_price' => $employee->day_price,
                'employee_code' => $employee->employee_code // تأكد من أن الحقل موجود في النموذج
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'الموظف غير موجود'
        ], 404);
    }

    public function searchEmployee(Request $request)
    {
        $employees = MainSalaryEmployee::where('employee_name', 'LIKE', "%{$request->q}%")->orWhere('employee_code', 'LIKE', "%{$request->q}%")->limit(5)->get();
        return response()->json([
            'data' => $employees
        ]);
    }

    public function export(Request $request, $slug)
    {
        $com_code = Auth::user()->com_code;
        try {
            $financeClnPeriod = FinanceClnPeriod::where('com_code', $com_code)
                ->where('slug', $slug)
                ->first();

            if (!$financeClnPeriod) {
                return redirect()->back()->withErrors(['error' => 'عفوا غير قادر للوصول على البيانات المطلوبة !']);
            }
            // الحصول على نفس شروط البحث المستخدمة في صفحة العرض
            $query = EmployeeSalaryAllowance::query()
                ->where('finance_cln_period_id', $financeClnPeriod->id)
                ->where('com_code', $com_code)
                ->with('mainSalaryEmployee');

            $this->filterByRequest($request, $query);

            $data = $query->get();

            return Excel::download(new EmployeeSalaryAllowanceExport($data), 'البدلات المتغيرة.xlsx');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء محاولة التصدير',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            // مرر قيمة السنة والشهر إلى كلاس الاستيراد
            Excel::import(new EmployeeSalaryAllowanceImport(), $request->file('file'));

            return back()->with('success', 'تم استيراد الملف بنجاح.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'فشل الاستيراد: ' . $e->getMessage()]);
        }
    }


    public function print(Request $request)
    {
        try {
            // الحصول على نفس شروط البحث المستخدمة في صفحة العرض
            $query = EmployeeSalaryAllowance::query()
                ->with(['financeClnPeriod', 'mainSalaryEmployee'])
                ->where('com_code', Auth::user()->com_code);

            $this->filterByRequest($request, $query);

            $allowances = $query->get();

            // أو طباعة مباشرة
            return view('dashboard.salaries.employee_salary_allowances.partials.print', compact('allowances'));
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.employee_salary_allowances.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function filterByRequest(Request $request, $query)
    {

        // تطبيق عوامل التصفية
        if ($request->filled('employee_code_search')) {
            $query->where('employee_code', $request->employee_code_search);
        }

        if ($request->filled('name')) {
            $query->whereHas('mainSalaryEmployee', function ($q) use ($request) {
                $q->where('employee_name', 'like', '%' . $request->name . '%');
            });
        }

        if ($request->filled('department')) {
            $query->whereHas('mainSalaryEmployee.department', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->department . '%');
            });
        }

        if ($request->filled('branch')) {
            $query->whereHas('mainSalaryEmployee.branch', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->branch . '%');
            });
        }


        if ($request->filled('allowance_id')) {
            $query->whereHas('allowance', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->allowance_id . '%');
            });
        }

        return  $query;
    }
}
