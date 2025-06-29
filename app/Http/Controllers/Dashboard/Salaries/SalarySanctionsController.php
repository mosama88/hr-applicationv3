<?php

namespace App\Http\Controllers\Dashboard\Salaries;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Models\FinanceClnPeriod;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Enums\FinanceClnPeriodsIsOpen;
use App\Models\EmployeeSalarySanction;
use App\Http\Requests\Dashboard\Salaries\SalarySanctionsRequest;
use App\Models\MainSalaryEmployee;

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
    public function store(SalarySanctionsRequest $request)
    {
        //
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

        $data = EmployeeSalarySanction::orderBy('id', 'DESC')
            ->where('com_code', $com_code)
            ->where('finance_cln_period_id', $financeClnPeriod->id)
            ->paginate(5);


        $employees = MainSalaryEmployee::where('com_code', '=', $com_code)->where('finance_cln_period_id', $financeClnPeriod->id)->distinct()->get('employee_code');
        // if ($employees) {
        //     foreach ($employees as $info) {
        //         $info->EmployeeData = get_Columns_where_row(new Employee, ['name', 'salary', 'day_price'], ['com_code' => $com_code, 'employee_code' => $info->employee_code]);
        //     }
        // }


        return view('dashboard.salaries.sanctions.show', compact('financeClnPeriod', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmployeeSalarySanction $sanction)
    {
        return view('dashboard.salaries.sanctions.edir', compact('sanction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmployeeSalarySanction $sanction)
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
        $employee = Employee::find($id);
        if ($employee) {
            return response()->json([
                'status' => true,
                'day_price' => $employee->day_price
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