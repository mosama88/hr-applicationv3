<?php

namespace App\Http\Controllers\Dashboard\Salaries;

use Illuminate\Http\Request;
use App\Models\FinanceClnPeriod;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Enums\FinanceClnPeriodsIsOpen;
use App\Models\EmployeeSalarySanction;

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
            return view('dashboard.salaries.sanctions.index',compact('data'));
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
        return view('dashboard.salaries.sanctions.create');
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
    public function show(EmployeeSalarySanction $sanction)
    {
        return view('dashboard.salaries.sanctions.show', compact('sanction'));
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
}