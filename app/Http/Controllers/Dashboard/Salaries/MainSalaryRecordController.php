<?php

namespace App\Http\Controllers\Dashboard\Salaries;

use Illuminate\Http\Request;
use App\Models\FinanceClnPeriod;
use App\Http\Controllers\Controller;
use App\Models\FinanceCalendar;
use Illuminate\Support\Facades\Auth;

class MainSalaryRecordController extends Controller
{
    public function index(FinanceCalendar $financeCalendar)
    {
        try {
            $com_code = Auth::user()->com_code;
            $data =  FinanceClnPeriod::select("*")->orderByDESC('finance_yr')->where('com_code', $com_code)->paginate(12);
            return view('dashboard.salaries.main_salary_records.index', compact('data'));
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }
}