<?php

namespace App\Http\Controllers\Dashboard\EmployeeAffairs;

use Illuminate\Http\Request;
use App\Models\AdditionalType;
use App\Enums\StatusActiveEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\AdditionalTypeService;
use App\Http\Requests\Dashboard\EmployeeAffairs\AdditionalTypeRequest;

class AdditionalTypeController extends Controller
{

    public function __construct(protected AdditionalTypeService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /**
         * Display a listing of the resource.
         */
        $data = $this->service->index();

        return view('dashboard.employee-affairs.additional_types.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.employee-affairs.additional_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdditionalTypeRequest $request)
    {
        $this->service->store($request);

        return redirect()->route('dashboard.additional_types.index')->with('success', 'تم أضافة الاضافى بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(AdditionalType $additionalType)
    {
        return view('dashboard.employee-affairs.additional_types.show', compact('additionalType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdditionalType $additionalType)
    {
        return view('dashboard.employee-affairs.additional_types.edit', compact('additionalType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdditionalTypeRequest $request, AdditionalType $additionalType)
    {
        $this->service->update($request, $additionalType);

        return redirect()->route('dashboard.additional_types.index')->with('success', 'تم تعديل الاضافى بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdditionalType $additionalType)
    {
        $this->service->destroy($additionalType);
        return response()->json([
            'success' => true,
            'message' => 'تم حذف الاضافى بنجاح'
        ]);
    }
}
