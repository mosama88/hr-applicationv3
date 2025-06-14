<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\AdminPanelSetting;
use Illuminate\Support\Facades\DB;

class AdminPanelSettingSeeder extends Seeder
{
    public function run()
    {
        AdminPanelSetting::factory()->count(10)->create();
    }
}