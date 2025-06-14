<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Models\Country;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\Settings\GovernorateRequest;

class GovernorateController extends Controller
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
        $data = Governorate::with(['createdBy:id,name', 'updatedBy:id,name'])->where('com_code', $com_code)->orderByDesc('id')->paginate(10);
        return view('dashboard.settings.governorates.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::get();
        return view('dashboard.settings.governorates.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GovernorateRequest $request)
    {
        $com_code =  Auth::user()->com_code;
        $active = StatusActiveEnum::ACTIVE;
        $dataValidate = $request->validated();
        $dataInsert = array_merge($dataValidate, [
            'created_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $active,
        ]);

        Governorate::create($dataInsert);
        return redirect()->route('dashboard.governorates.index')->with('success', 'تم أضافة الجنسية بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Governorate $governorate)
    {
        $countries = Country::get();

        return view('dashboard.settings.governorates.show', compact('governorate', 'countries'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Governorate $governorate)
    {
        $countries = Country::get();

        return view('dashboard.settings.governorates.edit', compact('governorate', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GovernorateRequest $request, Governorate $governorate)
    {
        $com_code =  Auth::user()->com_code;
        $dataValidate = $request->validated();
        $dataUpdate = array_merge($dataValidate, [
            'updated_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $request->active,
        ]);

        $governorate->update($dataUpdate);
        return redirect()->route('dashboard.governorates.index')->with('success', 'تم تعديل الجنسية بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Governorate $governorate)
    {
        $governorate->delete();
        return response()->json([
            'success' => true,
            'message' => 'تم حذف الجنسية بنجاح'
        ]);
    }
}