<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Models\JobCategory;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Exports\JobCategoryExport;
use App\Imports\JobCategoryImport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\Settings\JobCategoryService;
use App\Http\Requests\Dashboard\Settings\JobsCategoryRequest;

class JobCategoryController extends Controller
{

    public function __construct(protected JobCategoryService $service) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /**
         * Display a listing of the resource.
         */
        return view('dashboard.settings.job_categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.settings.job_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobsCategoryRequest $request)
    {
        try {
            $this->service->store($request);

            return redirect()->route('dashboard.job_categories.index')->with('success', 'تم أضافة الوظيفه بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.job_categories.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(JobCategory $jobCategory)
    {
        return view('dashboard.settings.job_categories.show', compact('jobCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobCategory $jobCategory)
    {
        return view('dashboard.settings.job_categories.edit', compact('jobCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobsCategoryRequest $request, JobCategory $jobCategory)
    {
        try {
            $this->service->update($request, $jobCategory);

            return redirect()->route('dashboard.job_categories.index')->with('success', 'تم تعديل الوظيفه بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.job_categories.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobCategory $jobCategory)
    {
        try {
            $this->service->destroy($jobCategory);
            return response()->json([
                'success' => true,
                'message' => 'تم حذف الوظيفه بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء محاولة الحذف',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    function searchJob_category(Request $request)
    {
        $jobCategories = $this->service->searchJob_category($request);
        return response()->json([
            'data' => $jobCategories
        ]);
    }

    public function export()
    {
        $com_code = Auth::user()->com_code;
        $dataExport = JobCategory::where('com_code', $com_code)->get();

        return Excel::download(new JobCategoryExport($dataExport), 'الوظائف.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);
        try {
            Excel::import(new JobCategoryImport(), $request->file('file'));

            return back()->with('success', 'تم استيراد الملف بنجاح.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'فشل الاستيراد: ' . $e->getMessage()]);
        }
    }
}
