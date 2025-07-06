<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Exports\BranchesExport;
use App\Imports\BranchesImport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\Settings\BranchService;
use App\Http\Requests\Dashboard\Settings\BranchRequest;

class BranchController extends Controller
{

    public function __construct(protected BranchService $service) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.settings.branches.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.settings.branches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BranchRequest $request)
    {
        try {
            $this->service->store($request);
            return redirect()->route('dashboard.branches.index')->with('success', 'تم أضافة الفرع بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.branches.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        return view('dashboard.settings.branches.show', compact('branch'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        return view('dashboard.settings.branches.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BranchRequest $request, Branch $branch)
    {
        try {
            $this->service->update($request, $branch);
            return redirect()->route('dashboard.branches.index')->with('success', 'تم تعديل الفرع بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.branches.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        try {
            $this->service->destroy($branch);
            return response()->json([
                'success' => true,
                'message' => 'تم حذف الفرع بنجاح'
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
        $dataExport = Branch::where('com_code', $com_code)->get();

        return Excel::download(new BranchesExport($dataExport), 'الفروع.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);
        try {
            Excel::import(new BranchesImport(), $request->file('file'));

            return back()->with('success', 'تم استيراد الملف بنجاح.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'فشل الاستيراد: ' . $e->getMessage()]);
        }
    }
}