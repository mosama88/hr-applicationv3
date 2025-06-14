<?php

namespace App\Http\Controllers\Dashboard\EmployeeAffairs;

use App\Models\Allowance;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\EmployeeAffairs\AllowanceRequest;

class AllowanceController extends Controller
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
        $data = Allowance::with(['createdBy:id,name', 'updatedBy:id,name'])->where('com_code', $com_code)->orderByDesc('id')->paginate(10);
        return view('dashboard.employee-affairs.allowances.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.employee-affairs.allowances.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AllowanceRequest $request)
    {
        $com_code =  Auth::user()->com_code;
        $active = StatusActiveEnum::ACTIVE;
        $dataValidate = $request->validated();
        $dataInsert = array_merge($dataValidate, [
            'created_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $active,
        ]);

        Allowance::create($dataInsert);
        return redirect()->route('dashboard.allowances.index')->with('success', 'تم أضافة البدلات بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Allowance $allowance)
    {
        return view('dashboard.employee-affairs.allowances.show', compact('allowance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Allowance $allowance)
    {
        return view('dashboard.employee-affairs.allowances.edit', compact('allowance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AllowanceRequest $request, Allowance $allowance)
    {
        $com_code =  Auth::user()->com_code;
        $dataValidate = $request->validated();
        $dataUpdate = array_merge($dataValidate, [
            'updated_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $request->active,
        ]);

        $allowance->update($dataUpdate);
        return redirect()->route('dashboard.allowances.index')->with('success', 'تم تعديل البدلات بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Allowance $allowance)
    {
        $allowance->delete();
        return response()->json([
            'success' => true,
            'message' => 'تم حذف البدلات بنجاح'
        ]);
    }
}