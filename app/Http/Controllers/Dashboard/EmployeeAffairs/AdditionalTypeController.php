<?php

namespace App\Http\Controllers\Dashboard\EmployeeAffairs;

use Illuminate\Http\Request;
use App\Models\AdditionalType;
use App\Enums\StatusActiveEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AdditionalTypeExport;
use App\Imports\AdditionalTypeImport;
use App\Services\EmployeeAffairs\AdditionalTypeService;
use App\Http\Requests\Dashboard\EmployeeAffairs\AdditionalTypeRequest;

class AdditionalTypeController extends Controller
{

    public function __construct(protected AdditionalTypeService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /**
         * Display a listing of the resource.
         */
        return view('dashboard.employee-affairs.additional_types.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.employee-affairs.additional_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdditionalTypeRequest $request)
    {
        try {
            $this->service->store($request);

            return redirect()->route('dashboard.additional_types.index')->with('success', 'تم أضافة الاضافى بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.additional_types.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AdditionalType $additionalType)
    {
        return view('dashboard.employee-affairs.additional_types.show', compact('additionalType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdditionalType $additionalType)
    {
        return view('dashboard.employee-affairs.additional_types.edit', compact('additionalType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdditionalTypeRequest $request, AdditionalType $additionalType)
    {
        try {
            $this->service->update($request, $additionalType);

            return redirect()->route('dashboard.additional_types.index')->with('success', 'تم تعديل الاضافى بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.additional_types.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdditionalType $additionalType)
    {
        try {
            $this->service->destroy($additionalType);
            return response()->json([
                'success' => true,
                'message' => 'تم حذف الاضافى بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء محاولة الحذف',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function export()
    {
        $com_code = Auth::user()->com_code;
        $dataExport = AdditionalType::where('com_code', $com_code)->get();

        return Excel::download(new AdditionalTypeExport($dataExport), 'أنواع الاضافى.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);
        try {
            Excel::import(new AdditionalTypeImport(), $request->file('file'));

            return back()->with('success', 'تم استيراد الملف بنجاح.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'فشل الاستيراد: ' . $e->getMessage()]);
        }
    }
}