<?php

namespace App\Http\Controllers\Dashboard\EmployeeAffairs;

use App\Models\City;
use App\Models\Branch;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Employee;
use App\Models\JobGrade;
use App\Models\Language;
use App\Models\BloodType;
use App\Models\Department;
use App\Models\ShiftsType;
use App\Models\Governorate;
use App\Models\JobCategory;
use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Models\Qualification;
use App\Enums\StatusActiveEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\AssignOp\ShiftLeft;
use App\Http\Requests\Dashboard\EmployeeAffairs\EmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /**
         * Display a listing of the resource.
         */
        $com_code = Auth::user()->com_code;
        $data = Employee::with(['createdBy:id,name', 'updatedBy:id,name'])->where('com_code', $com_code)->orderByDesc('id')->paginate(10);
        return view('dashboard.employee-affairs.employees.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $other['branches'] = Branch::select('id', 'name')->get();
        $other['blood_types'] = BloodType::select('id', 'name')->get();
        $other['job_grades'] = JobGrade::select('id', 'name')->get();
        $other['departments'] = Department::select('id', 'name')->get();
        $other['job_categories'] = JobCategory::select('id', 'name')->get();
        $other['shifts_types'] = ShiftsType::all();
        return view('dashboard.employee-affairs.employees.create', compact('other'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $com_code =  Auth::user()->com_code;
        $active = StatusActiveEnum::ACTIVE;

        $lastEmployeeCode = Employee::orderByDesc('employee_code')->value('employee_code');
        $newEmployeeCode = $lastEmployeeCode ? $lastEmployeeCode + 1 : 1;
        $validateData = $request->validated();



        $dataInsert = array_merge($validateData, [
            'employee_code' => $newEmployeeCode,
            'com_code' => $com_code,
            'active' =>  $active,
            'created_by' => Auth::user()->id,
        ]);

        // إنشاء الموظف أولاً
        $employee = Employee::create($dataInsert);

        // ثم رفع الصورة إذا وجدت
        if ($request->hasFile('photo')) {
            $employee->addMediaFromRequest('photo')
                ->toMediaCollection('photo');
        }

        return redirect()->route('dashboard.employees.index')->with('success', 'تم أضافة الموظف بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $other['qualifications'] = Qualification::select('id', 'name')->get();
        $other['branches'] = Branch::select('id', 'name')->get();
        $other['countries'] = Country::select('id', 'name')->get();
        $other['governorates'] = Governorate::select('id', 'name')->get();
        $other['cities'] = City::select('id', 'name')->get();
        $other['blood_types'] = BloodType::select('id', 'name')->get();
        $other['nationalities'] = Nationality::select('id', 'name')->get();
        $other['languages'] = Language::select('id', 'name')->get();
        $other['job_grades'] = JobGrade::select('id', 'name')->get();
        $other['departments'] = Department::select('id', 'name')->get();
        $other['job_categories'] = JobCategory::select('id', 'name')->get();
        $other['shifts_types'] = ShiftsType::all();
        $other['currencies'] = Currency::select('id', 'name')->get();
        return view('dashboard.employee-affairs.employees.show', compact('employee', 'other'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $other['qualifications'] = Qualification::select('id', 'name')->get();
        $other['branches'] = Branch::select('id', 'name')->get();
        $other['countries'] = Country::select('id', 'name')->get();
        $other['governorates'] = Governorate::select('id', 'name')->get();
        $other['cities'] = City::select('id', 'name')->get();
        $other['blood_types'] = BloodType::select('id', 'name')->get();
        $other['nationalities'] = Nationality::select('id', 'name')->get();
        $other['languages'] = Language::select('id', 'name')->get();
        $other['job_grades'] = JobGrade::select('id', 'name')->get();
        $other['departments'] = Department::select('id', 'name')->get();
        $other['job_categories'] = JobCategory::select('id', 'name')->get();
        $other['shifts_types'] = ShiftsType::all();
        $other['currencies'] = Currency::select('id', 'name')->get();
        return view('dashboard.employee-affairs.employees.edit', compact('employee', 'other'));
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

    public function getGovernorates($countryId)
    {
        $governorates = Governorate::where('country_id', $countryId)->pluck('name', 'id');
        return response()->json($governorates);
    }

    public function getCities($governorateId)
    {
        $cities = City::where('governorate_id', $governorateId)->pluck('name', 'id');
        return response()->json($cities);
    }
}