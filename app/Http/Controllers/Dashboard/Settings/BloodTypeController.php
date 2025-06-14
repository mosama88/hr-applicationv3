<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Models\BloodType;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\Settings\BloodTypeRequest;

class BloodTypeController extends Controller
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
        $data = BloodType::with(['createdBy:id,name', 'updatedBy:id,name'])->where('com_code', $com_code)->orderByDesc('id')->paginate(10);
        return view('dashboard.settings.bloodTypes.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.settings.bloodTypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BloodTypeRequest $request)
    {
        $com_code =  Auth::user()->com_code;
        $active = StatusActiveEnum::ACTIVE;
        $dataValidate = $request->validated();
        $dataInsert = array_merge($dataValidate, [
            'created_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $active,
        ]);

        BloodType::create($dataInsert);
        return redirect()->route('dashboard.bloodTypes.index')->with('success', 'تم أضافة فصيلة الدم بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(BloodType $bloodType)
    {
        return view('dashboard.settings.bloodTypes.show', compact('bloodType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BloodType $bloodType)
    {
        return view('dashboard.settings.bloodTypes.edit', compact('bloodType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BloodTypeRequest $request, BloodType $bloodType)
    {
        $com_code =  Auth::user()->com_code;
        $dataValidate = $request->validated();
        $dataUpdate = array_merge($dataValidate, [
            'updated_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $request->active,
        ]);

        $bloodType->update($dataUpdate);
        return redirect()->route('dashboard.bloodTypes.index')->with('success', 'تم تعديل فصيلة الدم بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BloodType $bloodType)
    {
        $bloodType->delete();
        return response()->json([
            'success' => true,
            'message' => 'تم حذف فصيلة الدم بنجاح'
        ]);
    }
}