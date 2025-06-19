<?php

namespace App\Http\Controllers\Dashboard\Settings;

use Illuminate\Http\Request;
use App\Models\AdminPanelSetting;
use App\Http\Controllers\Controller;
use App\Services\Settings\AdminPanelSettingService;
use App\Http\Requests\Dashboard\Settings\AdminPanelSettingRequest;

class AdminPanelSettingController extends Controller
{


    public function __construct(protected AdminPanelSettingService $adminPanelSettingService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->adminPanelSettingService->index();
        if ($data == null) {
            return redirect('dashboard')->withErrors(['error' => 'لا توجد أعدادت الشركة للموظف']);
        }
        return view('dashboard.settings.admin_panel_settings.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
    public function edit(AdminPanelSetting $adminPanelSetting)
    {
        return view('dashboard.settings.admin_panel_settings.edit', compact('adminPanelSetting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminPanelSettingRequest $request, AdminPanelSetting $adminPanelSetting)
    {
        $this->adminPanelSettingService->update($request, $adminPanelSetting);
        session()->flash('success', 'تم تعديل الشركة بنجاح');
        return redirect()->route('dashboard.admin_panel_settings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}