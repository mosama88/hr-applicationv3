<?php

namespace App\Http\Controllers\Dashboard\AdminRoles;

use App\Models\Admin;
use App\Exports\AdminExport;
use App\Imports\AdminImport;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\Dashboard\AdminRequest;


class AdminController extends Controller
{

    public function index()
    {
        try {
            $com_code  = Auth::user()->com_code;
            $data = Admin::where('com_code', $com_code)->orderByDesc('id')->paginate(10);
            return view('dashboard.admin-roles.admins.index', compact('data'));
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('dashboard.admin-roles.admins.create');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.admins.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        try {
            $com_code =  Auth::user()->com_code;

            $dataValidated =  $request->validated();
            $dataInsert = array_merge($dataValidated, [
                'created_by' => Auth::user()->id,
                'password' => Hash::make('password'),
                'com_code' => $com_code,
                'active' => StatusActiveEnum::ACTIVE,
            ]);
            Admin::create($dataInsert);
            return redirect()->route('dashboard.admins.index')->with('success', 'تم أضافة الأدمن بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.admins.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        try {
            return view('dashboard.admin-roles.admins.show', compact('admin'));
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.admins.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        try {
            return view('dashboard.admin-roles.admins.edit', compact('admin'));
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.admins.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, Admin $admin)
    {
        try {
            $com_code =  Auth::user()->com_code;
            $dataValidated =  $request->validated();
            $dataUpdate = array_merge($dataValidated, [
                'updated_by' => Auth::user()->id,
                'password' => Hash::make($request->password),
                'com_code' => $com_code,
                'active' => $request->active,
            ]);
            $admin->update($dataUpdate);
            return redirect()->route('dashboard.admins.index')->with('success', 'تم تعديل بيانات الأدمن بنجاح');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.admins.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        try {
            $admin->delete();
            return response()->json([
                'success' => true,
                'message' => 'تم حذف الادمن بنجاح'
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
        try {
            $com_code = Auth::user()->com_code;
            $dataExport = Admin::where('com_code', $com_code)->get();

            return Excel::download(new AdminExport($dataExport), 'المستخدمين.xlsx');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.admins.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);
        try {
            Excel::import(new AdminImport(), $request->file('file'));

            return back()->with('success', 'تم استيراد الملف بنجاح.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'فشل الاستيراد: ' . $e->getMessage()]);
        }
    }
}