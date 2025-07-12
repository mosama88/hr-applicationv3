<?php

namespace App\Http\Controllers\Dashboard\AdminRoles;

use App\Models\Admin;
use App\Exports\AdminExport;
use App\Imports\AdminImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\Dashboard\AdminRequest;


class AdminController extends Controller
{

    public function index()
    {
        $com_code  = Auth::user()->com_code;
        $data = Admin::where('com_code', $com_code)->orderByDesc('id')->paginate(10);
        return view('dashboard.admin-roles.admins.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admin-roles.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function export()
    {
        $com_code = Auth::user()->com_code;
        $dataExport = Admin::where('com_code', $com_code)->get();

        return Excel::download(new AdminExport($dataExport), 'المستخدمين.xlsx');
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