<?php

namespace App\Http\Controllers\Dashboard\Salaries;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Enums\IsArchivedEnum;
use App\Enums\StatusActiveEnum;
use App\Models\FinanceClnPeriod;
use App\Models\MainSalaryEmployee;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Enums\FinanceClnPeriodsIsOpen;
use App\Models\EmployeeSalarySanction;
use App\Http\Requests\Dashboard\Salaries\EmployeeSalarySanctionsRequest;

class SalarySanctionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $com_code = Auth::user()->com_code;
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
            return view('dashboard.salaries.sanctions.index', compact('data'));
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
        return view('dashboard.salaries.sanctions.create', compact('financeClnPeriod'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeSalarySanctionsRequest $request, $financeClnPeriodId)
    {
        $com_code = Auth::user()->com_code;
        $userId = Auth::user()->id;
        $financeClnPeriod = FinanceClnPeriod::where('com_code', $com_code)
            ->where('id', $financeClnPeriodId)
            ->firstOrFail();
        $validateData = $request->validated();
        $dataInsert = array_merge($validateData, [
            'finance_cln_period_id' => $financeClnPeriod->id,
            'main_salary_employee_id' => $request->main_salary_employee_id,
            'employee_code' => $request->employee_code,
            'day_price' => $request->day_price,
            'sanctions_type' => $request->sanctions_type,
            'value' => $request->value,
            'total' => $request->total,
            'notes' => $request->notes,
            'is_archived' => IsArchivedEnum::Unarchived,
            'com_code' => $com_code,
            'created_by' => $userId,
        ]);
        EmployeeSalarySanction::create($dataInsert);
        return redirect()->route('dashboard.sanctions.show', $financeClnPeriod->slug)->with('success', 'تم أضاف الجزاء بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(FinanceClnPeriod $financeClnPeriod)
    {

        $com_code = Auth::user()->com_code;
        $finance_cln_periods_data = FinanceClnPeriod::where('com_code', $com_code)->where('id', $financeClnPeriod->id)->get();
        if (!$finance_cln_periods_data) {
            return redirect()->back()->withErrors(['error' => 'عفوا غير قادر للوصول على البيانات المطلوبه !'])->withInput();
        }

        $data = EmployeeSalarySanction::filter(request()->all())->orderBy('id', 'DESC')
            ->where('com_code', $com_code)
            ->where('finance_cln_period_id', $financeClnPeriod->id)
            ->paginate(5);

        return view('dashboard.salaries.sanctions.show', compact('financeClnPeriod', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function showData(EmployeeSalarySanction $sanction, FinanceClnPeriod $financeClnPeriod)
    {
        return view('dashboard.salaries.sanctions.show_data', compact('sanction', 'financeClnPeriod'));
    }

    public function edit(EmployeeSalarySanction $sanction, FinanceClnPeriod $financeClnPeriod)
    {
        return view('dashboard.salaries.sanctions.edit', compact('sanction', 'financeClnPeriod'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeSalarySanctionsRequest $request, EmployeeSalarySanction $sanction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeSalarySanction $sanction)
    {
        //
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
}