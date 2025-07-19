<?php

namespace App\Http\Controllers\Dashboard\Salaries;

use Illuminate\Http\Request;
use App\Models\MainSalaryEmployee;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\EmployeeSalaryPermanentLoan;

class EmployeeSalaryPermanentLoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $com_code = Auth::user()->com_code;

            $data = EmployeeSalaryPermanentLoan::with([
                'mainSalaryEmployee' => function ($q) {
                    $q->select(['id', 'employee_code', 'employee_name', 'department_code', 'branch_id']);
                },
                'mainSalaryEmployee.employee' => function ($q) {
                    $q->select(['id', 'employee_code', 'name', 'gender'])->with('media');
                }
            ])->filter(request()->all())
                ->orderBy('id', 'DESC')
                ->where('com_code', $com_code)
                ->paginate(5);
            return view('dashboard.salaries.Employee_salary_permanent_loan.index', compact('data'));
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.salaries.Employee_salary_permanent_loan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getDayPrice($id)
    {
        try {
            $employee = MainSalaryEmployee::find($id); // تأكد من استخدام النموذج الصحيح

            if ($employee) {
                return response()->json([
                    'status' => true,
                    'day_price' => $employee->day_price,
                    'employee_salary' => $employee->salary,
                    'employee_code' => $employee->employee_code // تأكد من أن الحقل موجود في النموذج
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'الموظف غير موجود'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء محاولة الحذف',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}