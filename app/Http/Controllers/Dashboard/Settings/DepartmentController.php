<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Exports\DepartmentExport;
use App\Imports\DepartmentImport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\Settings\DepartmentService;
use App\Http\Requests\Dashboard\Settings\DepartmentRequest;

class DepartmentController extends Controller
{

    public function __construct(protected DepartmentService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.settings.departments.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.settings.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        try {
            $this->service->store($request);
            return redirect()->route('dashboard.departments.index')->with('success', 'تم أضافة الاداره بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.departments.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        return view('dashboard.settings.departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('dashboard.settings.departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        try {
            $this->service->update($request, $department);

            return redirect()->route('dashboard.departments.index')->with('success', 'تم تعديل الاداره بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.departments.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        try {
            $this->service->destroy($department);

            return response()->json([
                'success' => true,
                'message' => 'تم حذف الاداره بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء محاولة الحذف',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    function searchDepartment(Request $request)
    {
        $departments =  $this->service->searchDepartment($request);
        return response()->json([
            'data' => $departments
        ]);
    }

    public function export()
    {
        $com_code = Auth::user()->com_code;
        $dataExport = Department::where('com_code', $com_code)->get();

        return Excel::download(new DepartmentExport($dataExport), 'الادارات.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);
        try {
            Excel::import(new DepartmentImport(), $request->file('file'));

            return back()->with('success', 'تم استيراد الملف بنجاح.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'فشل الاستيراد: ' . $e->getMessage()]);
        }
    }
}
