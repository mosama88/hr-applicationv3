<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Exports\CurrencyExport;
use App\Imports\CurrencyImport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\Settings\CurrencyService;
use App\Http\Requests\Dashboard\Settings\CurrencyRequest;

class CurrencyController extends Controller
{

    public function __construct(protected CurrencyService $service) {}



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.settings.currencies.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.settings.currencies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CurrencyRequest $request)
    {
        try {
            $this->service->store($request);

            return redirect()->route('dashboard.currencies.index')->with('success', 'تم أضافة العملة بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.currencies.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Currency $currency)
    {
        return view('dashboard.settings.currencies.show', compact('currency'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Currency $currency)
    {
        return view('dashboard.settings.currencies.edit', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CurrencyRequest $request, Currency $currency)
    {
        try {
            $this->service->update($request, $currency);

            return redirect()->route('dashboard.currencies.index')->with('success', 'تم تعديل العملة بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.currencies.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Currency $currency)
    {
        try {
            $this->service->destroy($currency);

            return response()->json([
                'success' => true,
                'message' => 'تم حذف العملة بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء محاولة الحذف',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    function searchCurrency(Request $request)
    {
        $currencies =  $this->service->searchCurrency($request);
        return response()->json([
            'data' => $currencies
        ]);
    }

    public function export()
    {
        $com_code = Auth::user()->com_code;
        $dataExport = Currency::where('com_code', $com_code)->get();

        return Excel::download(new CurrencyExport($dataExport), 'العملات.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);
        try {
            Excel::import(new CurrencyImport(), $request->file('file'));

            return back()->with('success', 'تم استيراد الملف بنجاح.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'فشل الاستيراد: ' . $e->getMessage()]);
        }
    }
}