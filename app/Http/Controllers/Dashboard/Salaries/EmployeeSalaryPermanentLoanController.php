<?php

namespace App\Http\Controllers\Dashboard\Salaries;

use Illuminate\Http\Request;
use App\Enums\IsArchivedEnum;
use App\Models\FinanceClnPeriod;
use App\Models\MainSalaryEmployee;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Enums\FinanceClnPeriodsIsOpen;
use App\Exports\EmployeeSalaryLoanExport;
use App\Models\EmployeeSalaryPermanentLoan;
use App\Exports\EmployeeSalaryPermanentLoanExport;
use App\Imports\EmployeeSalaryPermanentLoanImport;
use App\Http\Requests\Dashboard\Salaries\EmployeeSalaryPermanentLoanRequest;

class EmployeeSalaryPermanentLoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    
}