<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Services\Settings\CountryService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\Settings\CountryRequest;

class CountryController extends Controller
{

    public function __construct(protected CountryService $service) {}



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.settings.countries.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.settings.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryRequest $request)
    {
        try {
            $this->service->store($request);

            return redirect()->route('dashboard.countries.index')->with('success', 'تم أضافة البلد بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.countries.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        return view('dashboard.settings.countries.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        return view('dashboard.settings.countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryRequest $request, Country $country)
    {
        try {
            $this->service->update($request, $country);

            return redirect()->route('dashboard.countries.index')->with('success', 'تم تعديل البلد بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.countries.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        try {
            $this->service->destroy($country);
            return response()->json([
                'success' => true,
                'message' => 'تم حذف البلد بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء محاولة الحذف',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    function searchCountry(Request $request)
    {
        $countries = $this->service->searchCountry($request);

        return response()->json([
            'data' => $countries
        ]);
    }
}