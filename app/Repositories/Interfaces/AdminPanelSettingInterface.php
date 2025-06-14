<?php

namespace App\Repositories\Interfaces;

use App\Models\AdminPanelSetting;
use App\Http\Requests\Dashboard\Settings\AdminPanelSettingRequest;

interface AdminPanelSettingInterface
{
    public function getData();
  public function updateData(AdminPanelSettingRequest $request, AdminPanelSetting $adminPanelSetting);
}