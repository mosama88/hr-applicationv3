<?php

namespace App\Http\Controllers\Dashboard\EmployeeAffairs;

use App\Models\City;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\JobGrade;
use App\Models\BloodType;
use App\Models\ShiftsType;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        $other['governorates'] = Governorate::select('id', 'name')->get();
        $other['cities'] = City::select('id', 'name')->get();
        $other['blood_types'] = BloodType::select('id', 'name')->get();
        $other['job_grades'] = JobGrade::select('id', 'name')->get();
        $other['shifts_types'] = ShiftsType::all();
        return view('dashboard.employee-affairs.employees.create', compact('other'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        try {
            DB::beginTransaction();
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

            if ($request->hasFile('cv')) {
                $employee->addMediaFromRequest('cv')
                    ->toMediaCollection('cv');
            }
            DB::commit();
            return redirect()->route('dashboard.employees.index')->with('success', 'تم أضافة الموظف بنجاح');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'عفوآ حدث خطأ ما ' . $ex->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $other['branches'] = Branch::select('id', 'name')->get();
        $other['governorates'] = Governorate::select('id', 'name')->get();
        $other['cities'] = City::select('id', 'name')->get();
        $other['blood_types'] = BloodType::select('id', 'name')->get();
        $other['job_grades'] = JobGrade::select('id', 'name')->get();
        $other['shifts_types'] = ShiftsType::all();
        return view('dashboard.employee-affairs.employees.show', compact('employee', 'other'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $other['branches'] = Branch::select('id', 'name')->get();
        $other['governorates'] = Governorate::select('id', 'name')->get();
        $other['cities'] = City::select('id', 'name')->get();
        $other['blood_types'] = BloodType::select('id', 'name')->get();
        $other['job_grades'] = JobGrade::select('id', 'name')->get();
        $other['shifts_types'] = ShiftsType::all();
        return view('dashboard.employee-affairs.employees.edit', compact('employee', 'other'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        try {
            DB::beginTransaction();

            $com_code =  Auth::user()->com_code;
            $validateData = $request->validated();
            $dataUpdate = array_merge($validateData, [
                'com_code' => $com_code,
                'active' =>  $request->active,
                'updated_by' => Auth::user()->id,
            ]);
            if ($request->hasFile('photo')) {
                // Remove old photo if exists
                $employee->clearMediaCollection('photo');

                // Upload new photo
                $employee->addMediaFromRequest('photo')
                    ->toMediaCollection('photo');
            }

            if ($request->hasFile('cv')) {
                // Remove old cv if exists
                $employee->clearMediaCollection('cv');

                // Upload new cv
                $employee->addMediaFromRequest('cv')
                    ->toMediaCollection('cv');
            }

            // إنشاء الموظف أولاً
            $employee->update($dataUpdate);
            DB::commit();
            return redirect()->route('dashboard.employees.index')->with('success', 'تم تعديل الموظف بنجاح');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'عفوآ حدث خطأ ما ' . $ex->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {
            // حذف الملفات المرفوعة أولاً
            if ($employee->getFirstMedia('photo')) {
                $employee->clearMediaCollection('photo');
            }

            if ($employee->getFirstMedia('cv')) {
                $employee->clearMediaCollection('cv');
            }

            // ثم حذف سجل الموظف من قاعدة البيانات
            $employee->delete();

            return response()->json([
                'success' => true,
                'message' => 'تم حذف الموظف وملفاته بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء محاولة الحذف',
                'error' => $e->getMessage()
            ], 500);
        }
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