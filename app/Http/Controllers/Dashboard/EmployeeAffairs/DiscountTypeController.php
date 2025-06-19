<?php

namespace App\Http\Controllers\Dashboard\EmployeeAffairs;

use App\Models\DiscountType;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\EmployeeAffairs\DiscountTypeService;
use App\Http\Requests\Dashboard\EmployeeAffairs\DiscountTypeRequest;

class DiscountTypeController extends Controller
{
    public function __construct(protected DiscountTypeService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /**
         * Display a listing of the resource.
         */
        $data = $this->service->index();

        return view('dashboard.employee-affairs.discount_types.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.employee-affairs.discount_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DiscountTypeRequest $request)
    {
        $this->service->store($request);

        return redirect()->route('dashboard.discount_types.index')->with('success', 'تم أضافة أنواع الخصومات بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(DiscountType $discountType)
    {
        return view('dashboard.employee-affairs.discount_types.show', compact('discountType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DiscountType $discountType)
    {
        return view('dashboard.employee-affairs.discount_types.edit', compact('discountType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DiscountTypeRequest $request, DiscountType $discountType)
    {
        $this->service->update($request, $discountType);

        return redirect()->route('dashboard.discount_types.index')->with('success', 'تم تعديل أنواع الخصومات بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DiscountType $discountType)
    {
        $this->service->destroy($discountType);
        return response()->json([
            'success' => true,
            'message' => 'تم حذف أنواع الخصومات بنجاح'
        ]);
    }
}