<?php

namespace App\Http\Controllers\Dashboard\Settings;

use Illuminate\Http\Request;
use App\Models\Qualification;
use App\Enums\StatusActiveEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Settings\QualificationService;
use App\Http\Requests\Dashboard\Settings\QualificationRequest;

class QualificationController extends Controller
{

    public function __construct(protected QualificationService $service) {}



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /**
         * Display a listing of the resource.
         */
        return view('dashboard.settings.qualifications.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.settings.qualifications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QualificationRequest $request)
    {
        $this->service->store($request);

        return redirect()->route('dashboard.qualifications.index')->with('success', 'تم أضافة المؤهل بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Qualification $qualification)
    {
        return view('dashboard.settings.qualifications.show', compact('qualification'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Qualification $qualification)
    {
        return view('dashboard.settings.qualifications.edit', compact('qualification'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QualificationRequest $request, Qualification $qualification)
    {
        $this->service->update($request, $qualification);

        return redirect()->route('dashboard.qualifications.index')->with('success', 'تم تعديل المؤهل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Qualification $qualification)
    {
        $this->service->destroy($qualification);
        return response()->json([
            'success' => true,
            'message' => 'تم حذف المؤهل بنجاح'
        ]);
    }


    function searchQualification(Request $request)
    {
        $qualifications =  $this->service->searchQualification($request);
        return response()->json([
            'data' => $qualifications
        ]);
    }
}
