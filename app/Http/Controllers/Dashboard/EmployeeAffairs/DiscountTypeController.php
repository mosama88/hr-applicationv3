<?php

namespace App\Http\Controllers\Dashboard\EmployeeAffairs;

use App\Models\DiscountType;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\EmployeeAffairs\DiscountTypeRequest;

class DiscountTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /**
         * Display a listing of the resource.
         */
        $com_code = Auth::user()->com_code;
        $data = DiscountType::with(['createdBy:id,name', 'updatedBy:id,name'])->where('com_code', $com_code)->orderByDesc('id')->paginate(10);
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
        $com_code =  Auth::user()->com_code;
        $active = StatusActiveEnum::ACTIVE;
        $dataValidate = $request->validated();
        $dataInsert = array_merge($dataValidate, [
            'created_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $active,
        ]);

        DiscountType::create($dataInsert);
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
        $com_code =  Auth::user()->com_code;
        $dataValidate = $request->validated();
        $dataUpdate = array_merge($dataValidate, [
            'updated_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $request->active,
        ]);

        $discountType->update($dataUpdate);
        return redirect()->route('dashboard.discount_types.index')->with('success', 'تم تعديل أنواع الخصومات بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DiscountType $discountType)
    {
        $discountType->delete();
        return response()->json([
            'success' => true,
            'message' => 'تم حذف أنواع الخصومات بنجاح'
        ]);
    }
}