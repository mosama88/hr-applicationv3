<?php

namespace App\Services;

use App\Models\AdminPanelSetting;
use App\Repositories\Interfaces\AdminPanelSettingInterface;
use App\Http\Requests\Dashboard\Settings\AdminPanelSettingRequest;


class AdminPanelSettingService
{
    public function __construct(protected AdminPanelSettingInterface $AdminPanelSetting) {}

    public function index()
    {
        return $this->AdminPanelSetting->getData();
    }


    public function update(AdminPanelSettingRequest $request, AdminPanelSetting $adminPanelSetting)
    {

        return $this->AdminPanelSetting->updateData($request, $adminPanelSetting);
    }
}