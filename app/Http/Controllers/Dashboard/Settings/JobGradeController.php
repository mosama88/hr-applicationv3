<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Models\JobGrade;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\Settings\JobGradeRequest;

class JobGradeController extends Controller
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
        $data = JobGrade::with(['createdBy:id,name', 'updatedBy:id,name'])->where('com_code', $com_code)->orderByDesc('id')->paginate(10);
        return view('dashboard.settings.job_grades.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.settings.job_grades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobGradeRequest $request)
    {

        $com_code =  Auth::user()->com_code;
        $last_code = JobGrade::orderByDesc('job_grades_code')->where('com_code', $com_code)->value('job_grades_code');
        $new_code = $last_code ? $last_code + 1 : 1;
        $active = StatusActiveEnum::ACTIVE;
        $dataValidate = $request->validated();
        $dataInsert = array_merge($dataValidate, [
            'created_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $active,
            'job_grades_code' =>  $new_code,
        ]);

        JobGrade::create($dataInsert);
        return redirect()->route('dashboard.job_grades.index')->with('success', 'تم أضافة اللغه بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(JobGrade $jobGrade)
    {
        return view('dashboard.settings.job_grades.show', compact('jobGrade'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobGrade $jobGrade)
    {
        return view('dashboard.settings.job_grades.edit', compact('jobGrade'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobGradeRequest $request, JobGrade $jobGrade)
    {
        $com_code =  Auth::user()->com_code;
        $dataValidate = $request->validated();
        $dataUpdate = array_merge($dataValidate, [
            'updated_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $request->active,
        ]);

        $jobGrade->update($dataUpdate);
        return redirect()->route('dashboard.job_grades.index')->with('success', 'تم تعديل اللغه بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobGrade $jobGrade)
    {
        $jobGrade->delete();
        return response()->json([
            'success' => true,
            'message' => 'تم حذف اللغه بنجاح'
        ]);
    }
}