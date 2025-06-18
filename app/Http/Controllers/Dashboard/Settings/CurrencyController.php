<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Services\CurrencyService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\Settings\CurrencyRequest;

class CurrencyController extends Controller
{

    public function __construct(protected CurrencyService $service) {}



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /**
         * Display a listing of the resource.
         */

        $data = $this->service->index();

        return view('dashboard.settings.currencies.index', compact('data'));
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
        $com_code =  Auth::user()->com_code;
        $active = StatusActiveEnum::ACTIVE;
        $dataValidate = $request->validated();
        $dataInsert = array_merge($dataValidate, [
            'created_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $active,
        ]);

        Currency::create($dataInsert);
        return redirect()->route('dashboard.currencies.index')->with('success', 'تم أضافة العملة بنجاح');
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
        $com_code =  Auth::user()->com_code;
        $dataValidate = $request->validated();
        $dataUpdate = array_merge($dataValidate, [
            'updated_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $request->active,
        ]);

        $currency->update($dataUpdate);
        return redirect()->route('dashboard.currencies.index')->with('success', 'تم تعديل العملة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Currency $currency)
    {
        $currency->delete();
        return response()->json([
            'success' => true,
            'message' => 'تم حذف العملة بنجاح'
        ]);
    }

    function searchCurrency(Request $request)
    {
        $currencies = Currency::where('name', 'LIKE', "%{$request->q}%")->orWhere('currency_symbol', 'LIKE', "%{$request->q}%")->limit(5)->get();
        return response()->json([
            'data' => $currencies
        ]);
    }
}