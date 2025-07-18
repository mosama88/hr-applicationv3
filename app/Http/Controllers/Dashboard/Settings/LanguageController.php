<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Exports\LanguageExport;
use App\Imports\LanguageImport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\Settings\LanguageService;
use App\Http\Requests\Dashboard\Settings\LanguageRequest;

class LanguageController extends Controller
{

    public function __construct(protected LanguageService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /**
         * Display a listing of the resource.
         */

        return view('dashboard.settings.languages.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.settings.languages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LanguageRequest $request)
    {
        try {
            $this->service->store($request);

            return redirect()->route('dashboard.languages.index')->with('success', 'تم أضافة اللغه بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.languages.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Language $language)
    {
        return view('dashboard.settings.languages.show', compact('language'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Language $language)
    {
        return view('dashboard.settings.languages.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LanguageRequest $request, Language $language)
    {
        try {
            $this->service->update($request, $language);

            return redirect()->route('dashboard.languages.index')->with('success', 'تم تعديل اللغه بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.languages.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Language $language)
    {
        try {
            $this->service->destroy($language);
            return response()->json([
                'success' => true,
                'message' => 'تم حذف اللغه بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء محاولة الحذف',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    function searchlanguage(Request $request)
    {
        $languages = $this->service->searchlanguage($request);
        return response()->json([
            'data' => $languages
        ]);
    }

    public function export()
    {
        $com_code = Auth::user()->com_code;
        $dataExport = Language::where('com_code', $com_code)->get();

        return Excel::download(new LanguageExport($dataExport), 'اللغات.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);
        try {
            Excel::import(new LanguageImport(), $request->file('file'));

            return back()->with('success', 'تم استيراد الملف بنجاح.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'فشل الاستيراد: ' . $e->getMessage()]);
        }
    }
}
