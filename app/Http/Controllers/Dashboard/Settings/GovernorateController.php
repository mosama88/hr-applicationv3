<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Models\Country;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Exports\GovernorateExport;
use App\Imports\GovernorateImport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\Settings\GovernorateService;
use App\Http\Requests\Dashboard\Settings\GovernorateRequest;

class GovernorateController extends Controller
{

    public function __construct(protected GovernorateService $service) {}


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /**
         * Display a listing of the resource.
         */
        return view('dashboard.settings.governorates.index');
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
        try {
            $this->service->store($request);
            return redirect()->route('dashboard.governorates.index')->with('success', 'تم أضافة الجنسية بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.governorates.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Governorate $governorate)
    {
        try {
            $countries = Country::get();

            return view('dashboard.settings.governorates.show', compact('governorate', 'countries'));
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.governorates.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
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
        try {
            $this->service->update($request, $governorate);

            return redirect()->route('dashboard.governorates.index')->with('success', 'تم تعديل الجنسية بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.governorates.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Governorate $governorate)
    {
        try {
            $this->service->destroy($governorate);
            return response()->json([
                'success' => true,
                'message' => 'تم حذف الجنسية بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء محاولة الحذف',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function export()
    {
        $com_code = Auth::user()->com_code;
        $dataExport = Governorate::where('com_code', $com_code)->get();

        return Excel::download(new GovernorateExport($dataExport), 'المحافظات.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);
        try {
            Excel::import(new GovernorateImport(), $request->file('file'));

            return back()->with('success', 'تم استيراد الملف بنجاح.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'فشل الاستيراد: ' . $e->getMessage()]);
        }
    }
}
