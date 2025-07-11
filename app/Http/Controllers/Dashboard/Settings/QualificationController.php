<?php

namespace App\Http\Controllers\Dashboard\Settings;

use Illuminate\Http\Request;
use App\Models\Qualification;
use App\Enums\StatusActiveEnum;
use App\Exports\QualificationExport;
use App\Http\Controllers\Controller;
use App\Imports\QualificationImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\Settings\QualificationService;
use App\Http\Requests\Dashboard\Settings\QualificationRequest;

class QualificationController extends Controller
{

    public function __construct(protected QualificationService $service) {}



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /**
         * Display a listing of the resource.
         */
        return view('dashboard.settings.qualifications.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.settings.qualifications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QualificationRequest $request)
    {
        try {
            $this->service->store($request);

            return redirect()->route('dashboard.qualifications.index')->with('success', 'تم أضافة المؤهل بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.qualifications.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Qualification $qualification)
    {
        return view('dashboard.settings.qualifications.show', compact('qualification'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Qualification $qualification)
    {
        return view('dashboard.settings.qualifications.edit', compact('qualification'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QualificationRequest $request, Qualification $qualification)
    {
        try {
            $this->service->update($request, $qualification);

            return redirect()->route('dashboard.qualifications.index')->with('success', 'تم تعديل المؤهل بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.qualifications.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Qualification $qualification)
    {
        try {
            $this->service->destroy($qualification);
            return response()->json([
                'success' => true,
                'message' => 'تم حذف المؤهل بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء محاولة الحذف',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    function searchQualification(Request $request)
    {
        $qualifications =  $this->service->searchQualification($request);
        return response()->json([
            'data' => $qualifications
        ]);
    }

    public function export()
    {
        $com_code = Auth::user()->com_code;
        $dataExport = Qualification::where('com_code', $com_code)->get();

        return Excel::download(new QualificationExport($dataExport), 'المؤهلات.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);
        try {
            Excel::import(new QualificationImport(), $request->file('file'));

            return back()->with('success', 'تم استيراد الملف بنجاح.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'فشل الاستيراد: ' . $e->getMessage()]);
        }
    }
}
