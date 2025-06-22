<?php

namespace App\Http\Controllers\Dashboard\EmployeeAffairs;

use App\Models\Allowance;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Services\EmployeeAffairs\AllowanceService;
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

        return view('dashboard.employee-affairs.allowances.index');
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
        try {
            $this->service->store($request);

            return redirect()->route('dashboard.allowances.index')->with('success', 'تم أضافة البدلات بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.allowances.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
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
        try {
            $this->service->update($request, $allowance);

            return redirect()->route('dashboard.allowances.index')->with('success', 'تم تعديل البدلات بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.allowances.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Allowance $allowance)
    {
        try {
            $this->service->destroy($allowance);
            return response()->json([
                'success' => true,
                'message' => 'تم حذف البدلات بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء محاولة الحذف',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}