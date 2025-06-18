<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Services\DepartmentService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\Settings\DepartmentRequest;

class DepartmentController extends Controller
{

    public function __construct(protected DepartmentService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->service->index();
        return view('dashboard.settings.departments.index', compact('data'));
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
        $this->service->store($request);
        return redirect()->route('dashboard.departments.index')->with('success', 'تم أضافة الاداره بنجاح');
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
        $this->service->update($request, $department);

        return redirect()->route('dashboard.departments.index')->with('success', 'تم تعديل الاداره بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $this->service->destroy($department);

        return response()->json([
            'success' => true,
            'message' => 'تم حذف الاداره بنجاح'
        ]);
    }


    function searchDepartment(Request $request)
    {
        $departments =  $this->service->searchDepartment($request);
        return response()->json([
            'data' => $departments
        ]);
    }
}