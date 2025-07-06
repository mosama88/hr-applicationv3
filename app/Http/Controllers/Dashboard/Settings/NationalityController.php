<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Exports\NationalityExport;
use App\Imports\NationalityImport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\Settings\NationalityService;
use App\Http\Requests\Dashboard\Settings\NationalityRequest;

class NationalityController extends Controller
{

    public function __construct(protected NationalityService $service) {}



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /**
         * Display a listing of the resource.
         */
        return view('dashboard.settings.nationalities.index');
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
        try {
            $this->service->store($request);

            return redirect()->route('dashboard.nationalities.index')->with('success', 'تم أضافة الجنسية بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.nationalities.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
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
        try {
            $this->service->update($request, $nationality);

            return redirect()->route('dashboard.nationalities.index')->with('success', 'تم تعديل الجنسية بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.nationalities.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nationality $nationality)
    {
        try {
            $this->service->destroy($nationality);
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


    function searchNationality(Request $request)
    {
        $nationalities = $this->service->searchNationality($request);
        return response()->json([
            'data' => $nationalities
        ]);
    }

    public function export()
    {
        $com_code = Auth::user()->com_code;
        $dataExport = Nationality::where('com_code', $com_code)->get();

        return Excel::download(new NationalityExport($dataExport), 'الجنسيات.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);
        try {
            Excel::import(new NationalityImport(), $request->file('file'));

            return back()->with('success', 'تم استيراد الملف بنجاح.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'فشل الاستيراد: ' . $e->getMessage()]);
        }
    }
}
