<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Enums\AdminGenderEnum;
use App\Enums\StatusActiveEnum;
use Illuminate\Database\Seeder;
use App\Models\AdminPanelSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Enums\PanelSettingSystemStatusEnum;
use Database\Seeders\AdminPanelSettingSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->withPersonalTeam()->create();
        Admin::updateOrCreate([
            'com_code' => 6000,
            'name' => "Mohamed Osama",
            'email' => "mosama@gmail.com",
            'username' => "mosama",
            'password' => Hash::make('password'), // password
            'mobile' => '01228759920', // password
            'active' => StatusActiveEnum::ACTIVE,
            'gender' => AdminGenderEnum::Male,
            'created_by' => Auth::user()->id,
        ]);

        AdminPanelSetting::updateOrCreate([
            'com_code' => 6000,
            'company_name' => "Microsoft",
            'system_status' => PanelSettingSystemStatusEnum::Active,
            'mobile' => "01550565699",
            'address' => "Nasr City,Cairo ,Egypt",
            'email' => "info@microsoft.com",
            'after_minute_calculate_delay' => '15.00',
            'after_minute_calculate_early_departure' => '15.00',
            'after_minute_quarterday' => '30.00',
            'after_time_half_daycut' => '2.00',
            'after_time_allday_daycut' => '4.00',
            'monthly_vacation_balance' => '1.75',
            'after_days_begin_vacation' => '180',
            'first_balance_begin_vacation' => '10.50',
            'sanctions_value_first_absence' => '9.00',
            'sanctions_value_second_absence' => '10.00',
            'sanctions_value_thaird_absence' => '10.00',
            'sanctions_value_forth_absence' => '11.00',
            'created_by' => 1,
        ]);

        $this->call([
            AdminSeeder::class,
            FinanceCalendarSeeder::class,
            FinanceClnPeriodsSeeder::class,
            ShiftTypeSeeder::class,
            BranchSeeder::class,
            LanguageSeeder::class,
            CurrencySeeder::class,
            DepartmentSeeder::class,
            QualificationSeeder::class,
            NationalitySeeder::class,
            CountrySeeder::class,
            GovernorateSeeder::class,
            CitySeeder::class,
            BloodTypeSeeder::class,
            JobCategorySeeder::class,
            JobGradesSeeder::class,
            EmployeeSeeder::class,
            AdditionalTypeSeeder::class,
            AllowanceSeeder::class,
            DiscountTypeSeeder::class,
            // EmployeeSalaryAbsenceSeeder::class,
            // EmployeeSalaryAdditionalSeeder::class,
            // EmployeeSalaryAllowanceSeeder::class,
            // EmployeeSalaryDiscountSeeder::class,
            // EmployeeSalaryRewardSeeder::class,
            // EmployeeSalarySanctionSeeder::class,
            // EmployeeSalaryLoanSeeder::class,
        ]);
    }
}