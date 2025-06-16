<?php

namespace App\Http\Controllers\Dashboard\Settings;

use Illuminate\Http\Request;
use App\Models\Qualification;
use App\Enums\StatusActiveEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\Settings\QualificationRequest;

class QualificationController extends Controller
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
        $data = Qualification::with(['createdBy:id,name', 'updatedBy:id,name'])->where('com_code', $com_code)->orderByDesc('id')->paginate(10);
        return view('dashboard.settings.qualifications.index', compact('data'));
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
        $com_code =  Auth::user()->com_code;
        $active = StatusActiveEnum::ACTIVE;
        $dataValidate = $request->validated();
        $dataInsert = array_merge($dataValidate, [
            'created_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $active,
        ]);

        Qualification::create($dataInsert);
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
        $com_code =  Auth::user()->com_code;
        $dataValidate = $request->validated();
        $dataUpdate = array_merge($dataValidate, [
            'updated_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $request->active,
        ]);

        $qualification->update($dataUpdate);
        return redirect()->route('dashboard.qualifications.index')->with('success', 'تم تعديل المؤهل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Qualification $qualification)
    {
        $qualification->delete();
        return response()->json([
            'success' => true,
            'message' => 'تم حذف المؤهل بنجاح'
        ]);
    }


    function searchQualification(Request $request)
    {
        $qualifications = Qualification::where('name', 'LIKE', "%{$request->q}%")->limit(5)->get();
        return response()->json([
            'data' => $qualifications
        ]);
    }
}