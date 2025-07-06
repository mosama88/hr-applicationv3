<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Models\City;
use App\Exports\CityExport;
use App\Imports\CityImport;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\Settings\CityService;
use App\Http\Requests\Dashboard\Settings\CityRequest;

class CityController extends Controller
{

    public function __construct(protected CityService $service) {}


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /**
         * Display a listing of the resource.
         */
        return view('dashboard.settings.cities.index');
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
        try {
            $this->service->store($request);

            return redirect()->route('dashboard.cities.index')->with('success', 'تم أضافة المدينة بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.cities.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
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
        try {
            $this->service->update($request, $city);

            return redirect()->route('dashboard.cities.index')->with('success', 'تم تعديل المدينة بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.cities.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        try {
            $this->service->destroy($city);
            return response()->json([
                'success' => true,
                'message' => 'تم حذف المدينة بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء محاولة الحذف',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    function searchCity(Request $request)
    {
        $cities = $this->service->searchCity($request);

        return response()->json([
            'data' => $cities
        ]);
    }

    public function export()
    {
        $com_code = Auth::user()->com_code;
        $dataExport = City::where('com_code', $com_code)->get();

        return Excel::download(new CityExport($dataExport), 'المدن.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);
        try {
            Excel::import(new CityImport(), $request->file('file'));

            return back()->with('success', 'تم استيراد الملف بنجاح.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'فشل الاستيراد: ' . $e->getMessage()]);
        }
    }
}
