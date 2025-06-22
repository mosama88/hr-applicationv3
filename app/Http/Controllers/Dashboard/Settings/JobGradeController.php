<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Models\JobGrade;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Services\Settings\JobGradeService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\Settings\JobGradeRequest;

class JobGradeController extends Controller
{

    public function __construct(protected JobGradeService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /**
         * Display a listing of the resource.
         */

        return view('dashboard.settings.job_grades.index');
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
        try {
            $this->service->store($request);

            return redirect()->route('dashboard.job_grades.index')->with('success', 'تم أضافة الدرجه بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.job_grades.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
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
        try {
            $this->service->update($request, $jobGrade);

            return redirect()->route('dashboard.job_grades.index')->with('success', 'تم تعديل الدرجه بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.job_grades.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobGrade $jobGrade)
    {
        try {
            $this->service->destroy($jobGrade);
            return response()->json([
                'success' => true,
                'message' => 'تم حذف الدرجه بنجاح'
            ]);
         } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء محاولة الحذف',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}