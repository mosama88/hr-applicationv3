<?php

namespace App\Http\Controllers\Dashboard\EmployeeAffairs;

use App\Models\Allowance;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Services\AllowanceService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\EmployeeAffairs\AllowanceRequest;

class AllowanceController extends Controller
{
    public function __construct(protected AllowanceService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /**
         * Display a listing of the resource.
         */
        $data = $this->service->index();

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
        $this->service->store($request);

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
        $this->service->update($request, $allowance);

        return redirect()->route('dashboard.allowances.index')->with('success', 'تم تعديل البدلات بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Allowance $allowance)
    {
        $this->service->destroy($allowance);
        return response()->json([
            'success' => true,
            'message' => 'تم حذف البدلات بنجاح'
        ]);
    }
}
