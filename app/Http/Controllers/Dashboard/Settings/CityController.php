<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\Settings\CityRequest;

class CityController extends Controller
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
        $data = City::with(['createdBy:id,name', 'updatedBy:id,name'])->where('com_code', $com_code)->orderByDesc('id')->paginate(10);
        return view('dashboard.settings.cities.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $governorates = Governorate::get();
        return view('dashboard.settings.cities.create', compact('governorates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
    {
        $com_code =  Auth::user()->com_code;
        $active = StatusActiveEnum::ACTIVE;
        $dataValidate = $request->validated();
        $dataInsert = array_merge($dataValidate, [
            'created_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $active,
        ]);

        City::create($dataInsert);
        return redirect()->route('dashboard.cities.index')->with('success', 'تم أضافة المدينة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        $governorates = Governorate::get();

        return view('dashboard.settings.cities.show', compact('city', 'governorates'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        $governorates = Governorate::get();

        return view('dashboard.settings.cities.edit', compact('city', 'governorates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, City $city)
    {
        $com_code =  Auth::user()->com_code;
        $dataValidate = $request->validated();
        $dataUpdate = array_merge($dataValidate, [
            'updated_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $request->active,
        ]);

        $city->update($dataUpdate);
        return redirect()->route('dashboard.cities.index')->with('success', 'تم تعديل المدينة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        $city->delete();
        return response()->json([
            'success' => true,
            'message' => 'تم حذف المدينة بنجاح'
        ]);
    }


    function searchCity(Request $request)
    {
        $cities = City::where('name', 'LIKE', "%{$request->q}%")->limit(5)->get();
        return response()->json([
            'data' => $cities
        ]);
    }
}