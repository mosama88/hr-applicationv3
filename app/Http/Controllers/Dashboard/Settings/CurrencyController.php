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
        $this->service->store($request);

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
        $this->service->update($request, $currency);

        return redirect()->route('dashboard.currencies.index')->with('success', 'تم تعديل العملة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Currency $currency)
    {
        $this->service->destroy($currency);

        return response()->json([
            'success' => true,
            'message' => 'تم حذف العملة بنجاح'
        ]);
    }

    function searchCurrency(Request $request)
    {
        $currencies =  $this->service->searchCurrency($request);
        return response()->json([
            'data' => $currencies
        ]);
    }
}
