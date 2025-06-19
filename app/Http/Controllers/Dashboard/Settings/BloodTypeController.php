<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Models\BloodType;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Services\Settings\BloodTypeService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\Settings\BloodTypeRequest;

class BloodTypeController extends Controller
{

    public function __construct(protected BloodTypeService $service) {}


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /**
         * Display a listing of the resource.
         */
        $data = $this->service->index();
        return view('dashboard.settings.bloodTypes.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.settings.bloodTypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BloodTypeRequest $request)
    {
        $this->service->store($request);

        return redirect()->route('dashboard.bloodTypes.index')->with('success', 'تم أضافة فصيلة الدم بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(BloodType $bloodType)
    {
        return view('dashboard.settings.bloodTypes.show', compact('bloodType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BloodType $bloodType)
    {
        return view('dashboard.settings.bloodTypes.edit', compact('bloodType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BloodTypeRequest $request, BloodType $bloodType)
    {
        $this->service->update($request, $bloodType);

        return redirect()->route('dashboard.bloodTypes.index')->with('success', 'تم تعديل فصيلة الدم بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BloodType $bloodType)
    {
        $this->service->destroy($bloodType);
        return response()->json([
            'success' => true,
            'message' => 'تم حذف فصيلة الدم بنجاح'
        ]);
    }
}
