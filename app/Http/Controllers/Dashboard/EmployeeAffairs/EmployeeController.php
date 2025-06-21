<?php

namespace App\Http\Controllers\Dashboard\EmployeeAffairs;

use App\Models\City;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\JobGrade;
use App\Models\BloodType;
use App\Models\ShiftsType;
use App\Models\Governorate;
use App\Models\EmployeeFile;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Services\EmployeeAffairs\EmployeeService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\EmployeeAffairs\EmployeeRequest;
use App\Http\Requests\Dashboard\EmployeeAffairs\EmoloyeeFilesRequest;

class EmployeeController extends Controller
{
    public function __construct(protected EmployeeService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /**
         * Display a listing of the resource.
         */
        $data = $this->service->index();

        return view('dashboard.employee-affairs.employees.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $other['branches'] = Branch::where('active', StatusActiveEnum::ACTIVE)->select('id', 'name')->get();
        $other['governorates'] = Governorate::where('active', StatusActiveEnum::ACTIVE)->select('id', 'name')->get();
        $other['cities'] = City::where('active', StatusActiveEnum::ACTIVE)->select('id', 'name')->get();
        $other['blood_types'] = BloodType::where('active', StatusActiveEnum::ACTIVE)->select('id', 'name')->get();
        $other['job_grades'] = JobGrade::where('active', StatusActiveEnum::ACTIVE)->select('id', 'name')->get();
        $other['shifts_types'] = ShiftsType::where('active', StatusActiveEnum::ACTIVE)->get();
        return view('dashboard.employee-affairs.employees.create', compact('other'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        try {

            $this->service->store($request);
            return redirect()->route('dashboard.employees.index')->with('success', 'تم أضافة الموظف بنجاح');
        } catch (\Exception $e) {
            // تسجيل الخطأ في اللوج إن حبيت
            Log::error('خطأ أثناء حفظ الموظف: ' . $e->getMessage());
            return back()->with('error', 'حدث خطأ أثناء حفظ البيانات، يرجى المحاولة لاحقًا.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $com_code =  Auth::user()->com_code;
        $employeeFiles = EmployeeFile::orderByDesc('id')->where('employee_id', $employee->id)->where('com_code', $com_code)->get();
        $other['branches'] = Branch::where('active', StatusActiveEnum::ACTIVE)->select('id', 'name')->get();
        $other['governorates'] = Governorate::where('active', StatusActiveEnum::ACTIVE)->select('id', 'name')->get();
        $other['cities'] = City::where('active', StatusActiveEnum::ACTIVE)->select('id', 'name')->get();
        $other['blood_types'] = BloodType::where('active', StatusActiveEnum::ACTIVE)->select('id', 'name')->get();
        $other['job_grades'] = JobGrade::where('active', StatusActiveEnum::ACTIVE)->select('id', 'name')->get();
        $other['shifts_types'] = ShiftsType::where('active', StatusActiveEnum::ACTIVE)->get();
        return view('dashboard.employee-affairs.employees.show', compact('employee', 'other', 'employeeFiles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $other['branches'] = Branch::where('active', StatusActiveEnum::ACTIVE)->select('id', 'name')->get();
        $other['governorates'] = Governorate::where('active', StatusActiveEnum::ACTIVE)->select('id', 'name')->get();
        $other['cities'] = City::where('active', StatusActiveEnum::ACTIVE)->select('id', 'name')->get();
        $other['blood_types'] = BloodType::where('active', StatusActiveEnum::ACTIVE)->select('id', 'name')->get();
        $other['job_grades'] = JobGrade::where('active', StatusActiveEnum::ACTIVE)->select('id', 'name')->get();
        $other['shifts_types'] = ShiftsType::where('active', StatusActiveEnum::ACTIVE)->get();
        return view('dashboard.employee-affairs.employees.edit', compact('employee', 'other'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        try {
            $this->service->update($request, $employee);
            return redirect()->route('dashboard.employees.index')->with('success', 'تم تعديل الموظف بنجاح');
        } catch (\Exception $e) {
            // تسجيل الخطأ في اللوج إن حبيت
            Log::error('خطأ أثناء حفظ الموظف: ' . $e->getMessage());
            return back()->with('error', 'حدث خطأ أثناء حفظ البيانات، يرجى المحاولة لاحقًا.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {
            $this->service->destroy($employee);

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

    public function uploadFiles(EmoloyeeFilesRequest $request)
    {
        try {
            $employeeFile = $this->service->uploadFiles($request);
            // استجابة JSON للطلب AJAX
            return response()->json([
                'success' => true,
                'message' => 'تم إضافة الملف للموظف بنجاح',
                'file' => [
                    'id' => $employeeFile->id,
                    'name' => $employeeFile->file_name,
                    'url' => $employeeFile->getFirstMediaUrl('upload_file'),
                    'created_at' => $employeeFile->created_at->diffForHumans()
                ]
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء رفع الملف',
                'error' => config('app.debug') ? $ex->getMessage() : null
            ], 500);
        }
    }



    public function destroyUploadFiles($id)
    {
        try {
            $this->service->destroyUploadFiles($id);

            return response()->json([
                'success' => true,
                'message' => 'تم حذف الملف بنجاح',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء الحذف: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function filterEmploee()
    {
        $data = $this->service->filterEmploee();
        $other['branches'] = Branch::where('active', StatusActiveEnum::ACTIVE)->select('id', 'name')->get();
        $other['governorates'] = Governorate::where('active', StatusActiveEnum::ACTIVE)->select('id', 'name')->get();
        $other['cities'] = City::where('active', StatusActiveEnum::ACTIVE)->select('id', 'name')->get();
        $other['blood_types'] = BloodType::where('active', StatusActiveEnum::ACTIVE)->select('id', 'name')->get();
        $other['job_grades'] = JobGrade::where('active', StatusActiveEnum::ACTIVE)->select('id', 'name')->get();
        $other['shifts_types'] = ShiftsType::where('active', StatusActiveEnum::ACTIVE)->get();
        return view('dashboard.employee-affairs.employees.filter-employee', compact('data', 'other'));
    }
}