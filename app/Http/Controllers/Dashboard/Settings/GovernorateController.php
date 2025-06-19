<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Models\Country;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Http\Controllers\Controller;
use App\Services\GovernorateService;
use Illuminate\Support\Facades\Auth;
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
        $data = $this->service->index();

        return view('dashboard.settings.governorates.index', compact('data'));
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
        $this->service->store($request);
        return redirect()->route('dashboard.governorates.index')->with('success', 'تم أضافة الجنسية بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Governorate $governorate)
    {
        $countries = Country::get();

        return view('dashboard.settings.governorates.show', compact('governorate', 'countries'));
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
        $this->service->update($request, $governorate);

        return redirect()->route('dashboard.governorates.index')->with('success', 'تم تعديل الجنسية بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Governorate $governorate)
    {
        $this->service->destroy($governorate);
        return response()->json([
            'success' => true,
            'message' => 'تم حذف الجنسية بنجاح'
        ]);
    }
}