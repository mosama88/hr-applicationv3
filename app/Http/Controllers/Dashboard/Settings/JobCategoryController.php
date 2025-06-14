<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Models\JobCategory;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\Settings\JobsCategoryRequest;

class JobCategoryController extends Controller
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
        $data = JobCategory::with(['createdBy:id,name', 'updatedBy:id,name'])->where('com_code', $com_code)->orderByDesc('id')->paginate(10);
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
        $com_code =  Auth::user()->com_code;
        $active = StatusActiveEnum::ACTIVE;
        $dataValidate = $request->validated();
        $dataInsert = array_merge($dataValidate, [
            'created_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $active,
        ]);

        JobCategory::create($dataInsert);
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
        $com_code =  Auth::user()->com_code;
        $dataValidate = $request->validated();
        $dataUpdate = array_merge($dataValidate, [
            'updated_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $request->active,
        ]);

        $jobCategory->update($dataUpdate);
        return redirect()->route('dashboard.job_categories.index')->with('success', 'تم تعديل الوظيفه بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobCategory $jobCategory)
    {
        $jobCategory->delete();
        return response()->json([
            'success' => true,
            'message' => 'تم حذف الوظيفه بنجاح'
        ]);
    }
}
