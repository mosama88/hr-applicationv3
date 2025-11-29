<?php

namespace App\Http\Controllers\Dashboard\Salaries;

use Illuminate\Http\Request;
use App\Enums\IsArchivedEnum;
use App\Models\MainSalaryEmployee;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\EmployeeSalaryPermanentLoan;
use App\Http\Requests\Dashboard\Salaries\EmployeeSalaryPermanentLoanRequest;

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
    public function store(EmployeeSalaryPermanentLoanRequest $request)
    {
        try {
            $com_code = Auth::user()->com_code;
            $userId = Auth::user()->id;

            $validateData = $request->validated();
            $dataInsert = array_merge($validateData, [
                'notes' => $request->notes,
                'is_archived' => IsArchivedEnum::Unarchived,
                'com_code' => $com_code,
                'created_by' => $userId,
            ]);
            EmployeeSalaryPermanentLoan::create($dataInsert);
            return redirect()->route('dashboard.permanent_loans.index')->with('success', 'تم أضافة السلفه بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.permanent_loans.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeeSalaryPermanentLoan $employeeSalaryPermanentLoan)
    {
        return view('dashboard.salaries.Employee_salary_permanent_loan.show', compact('employeeSalaryPermanentLoan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmployeeSalaryPermanentLoan $employeeSalaryPermanentLoan)
    {
        return view('dashboard.salaries.Employee_salary_permanent_loan.edit', compact('employeeSalaryPermanentLoan'));
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