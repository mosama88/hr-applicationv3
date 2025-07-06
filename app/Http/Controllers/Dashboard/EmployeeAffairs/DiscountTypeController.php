<?php

namespace App\Http\Controllers\Dashboard\EmployeeAffairs;

use App\Models\DiscountType;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Exports\DiscountTypeExport;
use App\Imports\DiscountTypeImport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
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
        return view('dashboard.employee-affairs.discount_types.index');
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
        try {
            $this->service->store($request);

            return redirect()->route('dashboard.discount_types.index')->with('success', 'تم أضافة أنواع الخصومات بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.discount_types.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
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
        try {
            $this->service->update($request, $discountType);

            return redirect()->route('dashboard.discount_types.index')->with('success', 'تم تعديل أنواع الخصومات بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.discount_types.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DiscountType $discountType)
    {
        try {
            $this->service->destroy($discountType);
            return response()->json([
                'success' => true,
                'message' => 'تم حذف أنواع الخصومات بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء محاولة الحذف',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    public function export()
    {
        $com_code = Auth::user()->com_code;
        $dataExport = DiscountType::where('com_code', $com_code)->get();

        return Excel::download(new DiscountTypeExport($dataExport), 'أنواع الخصومات.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);
        try {
            Excel::import(new DiscountTypeImport(), $request->file('file'));

            return back()->with('success', 'تم استيراد الملف بنجاح.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'فشل الاستيراد: ' . $e->getMessage()]);
        }
    }
}