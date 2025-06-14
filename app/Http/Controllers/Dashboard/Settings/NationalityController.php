<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\Settings\NationalityRequest;

class NationalityController extends Controller
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
        $data = Nationality::with(['createdBy:id,name', 'updatedBy:id,name'])->where('com_code', $com_code)->orderByDesc('id')->paginate(10);
        return view('dashboard.settings.nationalities.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.settings.nationalities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NationalityRequest $request)
    {
        $com_code =  Auth::user()->com_code;
        $active = StatusActiveEnum::ACTIVE;
        $dataValidate = $request->validated();
        $dataInsert = array_merge($dataValidate, [
            'created_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $active,
        ]);

        Nationality::create($dataInsert);
        return redirect()->route('dashboard.nationalities.index')->with('success', 'تم أضافة الجنسية بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Nationality $nationality)
    {
        return view('dashboard.settings.nationalities.show', compact('nationality'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nationality $nationality)
    {
        return view('dashboard.settings.nationalities.edit', compact('nationality'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NationalityRequest $request, Nationality $nationality)
    {
        $com_code =  Auth::user()->com_code;
        $dataValidate = $request->validated();
        $dataUpdate = array_merge($dataValidate, [
            'updated_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $request->active,
        ]);

        $nationality->update($dataUpdate);
        return redirect()->route('dashboard.nationalities.index')->with('success', 'تم تعديل الجنسية بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nationality $nationality)
    {
        $nationality->delete();
        return response()->json([
            'success' => true,
            'message' => 'تم حذف الجنسية بنجاح'
        ]);
    }
}