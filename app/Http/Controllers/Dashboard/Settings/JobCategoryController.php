<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Models\JobCategory;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Http\Controllers\Controller;
use App\Services\JobCategoryService;
use Illuminate\Support\Facades\Auth;
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
        $data = $this->service->index();
        return view('dashboard.settings.job_categories.index', compact('data'));
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
        $this->service->store($request);

        return redirect()->route('dashboard.job_categories.index')->with('success', 'تم أضافة الوظيفه بنجاح');
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
        $this->service->update($request, $jobCategory);

        return redirect()->route('dashboard.job_categories.index')->with('success', 'تم تعديل الوظيفه بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobCategory $jobCategory)
    {
        $this->service->destroy($jobCategory);
        return response()->json([
            'success' => true,
            'message' => 'تم حذف الوظيفه بنجاح'
        ]);
    }


    function searchJob_category(Request $request)
    {
        $jobCategories = $this->service->searchJob_category($request);
        return response()->json([
            'data' => $jobCategories
        ]);
    }
}