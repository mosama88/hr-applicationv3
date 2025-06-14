<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Models\ShiftsType;
use Illuminate\Http\Request;
use App\Enums\ShiftTypesEnum;
use App\Enums\StatusActiveEnum;
use App\Services\ShiftTypesService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\Settings\ShiftsTypeRequest;

class ShiftTypesController extends Controller
{
    public function __construct(protected ShiftTypesService $service) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data  = $this->service->index();
        return view('dashboard.settings.shiftTypes.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.settings.shiftTypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShiftsTypeRequest $request)
    {

        $this->service->store($request);
        return redirect()->route('dashboard.shiftTypes.index')->with('success', 'تم أضافة الشفت بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(ShiftsType $shiftType)
    {
        return view('dashboard.settings.shiftTypes.show', compact('shiftType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShiftsType $shiftType)
    {
        return view('dashboard.settings.shiftTypes.edit', compact('shiftType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShiftsTypeRequest $request, ShiftsType $shiftType)
    {
        $this->service->update($request, $shiftType);

        return redirect()->route('dashboard.shiftTypes.index')->with('success', 'تم تعديل الشفت بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShiftsType $shiftType)
    {
        $this->service->destroy($shiftType);
        return response()->json([
            'success' => true,
            'message' => 'تم حذف الشفت بنجاح'
        ]);
    }
}
