<?php

namespace App\Repositories\Settings;

use App\Models\AdminPanelSetting;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Enums\PanelSettingSystemStatusEnum;
use App\Repositories\Interfaces\Settings\AdminPanelSettingInterface;
use App\Http\Requests\Dashboard\Settings\AdminPanelSettingRequest;

class AdminPanelSettingRepository implements AdminPanelSettingInterface
{


    public function getData()
    {
        $com_code = Auth::user()->com_code;
        $data = AdminPanelSetting::where('com_code', $com_code)->where('system_status', PanelSettingSystemStatusEnum::Active)->first();

        return $data;
    }


    public function updateData(AdminPanelSettingRequest $request, AdminPanelSetting $adminPanelSetting)
    {
        $com_code = Auth::user()->com_code;
        $adminPanelSettings = $request->validated();
        $dataUpdate =  array_merge(
            $adminPanelSettings,
            [
                'updated_by' => Auth::user()->id,
                'com_code' => $com_code,
            ]
        );


        if ($request->hasFile('logo')) {

            $this->handleImage($adminPanelSetting);
        }

        // $adminPanelSetting->addMediaFromRequest('logo')
        //     ->toMediaCollection('logo');
        $adminPanelSetting->update($dataUpdate);


        return $adminPanelSetting;
    }


    public function handleImage($adminPanelSetting)
    {
        // Remove old image if exists
        $adminPanelSetting->clearMediaCollection('logo');

        // Upload new image
        $adminPanelSetting->addMediaFromRequest('logo')
            ->toMediaCollection('logo');
    }
}