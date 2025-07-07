<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\Settings\CityController;
use App\Http\Controllers\Dashboard\Settings\BranchController;
use App\Http\Controllers\Dashboard\Settings\CountryController;
use App\Http\Controllers\Dashboard\Settings\CurrencyController;
use App\Http\Controllers\Dashboard\Settings\JobGradeController;
use App\Http\Controllers\Dashboard\Settings\LanguageController;
use App\Http\Controllers\Dashboard\Settings\BloodTypeController;
use App\Http\Controllers\Dashboard\Settings\DepartmentController;
use App\Http\Controllers\Dashboard\Settings\ShiftTypesController;
use App\Http\Controllers\Dashboard\Settings\GovernorateController;
use App\Http\Controllers\Dashboard\Settings\JobCategoryController;
use App\Http\Controllers\Dashboard\Settings\NationalityController;
use App\Http\Controllers\Dashboard\Settings\QualificationController;
use App\Http\Controllers\Dashboard\EmployeeAffairs\EmployeeController;
use App\Http\Controllers\Dashboard\Salaries\SalarySanctionsController;
use App\Http\Controllers\Dashboard\Settings\FinanceCalendarController;
use App\Http\Controllers\Dashboard\EmployeeAffairs\AllowanceController;
use App\Http\Controllers\Dashboard\Salaries\MainSalaryRecordController;
use App\Http\Controllers\Dashboard\Settings\AdminPanelSettingController;
use App\Http\Controllers\Dashboard\EmployeeAffairs\DiscountTypeController;
use App\Http\Controllers\Dashboard\EmployeeAffairs\AdditionalTypeController;
use App\Http\Controllers\Dashboard\Salaries\EmployeeSalaryAbsenceController;
use App\Http\Controllers\Dashboard\Salaries\EmployeeSalaryAdditionalController;


Route::middleware(['auth:admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index')->middleware('redirect.employee');
    //################################### الأعدات #########################################
    Route::resource('admin_panel_settings', AdminPanelSettingController::class);
    //################################### السنوات المالية ##################################
    Route::resource('financeCalendars', FinanceCalendarController::class);
    Route::controller(FinanceCalendarController::class)->prefix('/financeCalendars')->name('financeCalendars.')->group(function () {
        Route::patch('/open-year/{financeCalendar}', 'openYear')->name('open-year');
        Route::patch('/close-year/{financeCalendar}', 'closeYear')->name('close-year');
    });
    //################################### الفروع ##################################
    Route::get('branches/export', [BranchController::class, 'export'])->name('branches.export');
    Route::post('branches/import', [BranchController::class, 'import'])->name('branches.import');
    Route::resource('branches', BranchController::class);

    //################################### الشفتات ##################################
    Route::resource('shiftTypes', ShiftTypesController::class);
    //################################### الدول ##################################
    Route::get('countries/export', [CountryController::class, 'export'])->name('countries.export');
    Route::post('countries/import', [CountryController::class, 'import'])->name('countries.import');
    Route::resource('countries', CountryController::class);
    //################################### اللغات ##################################
    Route::get('languages/export', [LanguageController::class, 'export'])->name('languages.export');
    Route::post('languages/import', [LanguageController::class, 'import'])->name('languages.import');
    Route::resource('languages', LanguageController::class);
    //################################### العملات ##################################
    Route::get('currencies/export', [CurrencyController::class, 'export'])->name('currencies.export');
    Route::post('currencies/import', [CurrencyController::class, 'import'])->name('currencies.import');
    Route::resource('currencies', CurrencyController::class);
    //################################### الادارات ##################################
    Route::get('departments/export', [DepartmentController::class, 'export'])->name('departments.export');
    Route::post('departments/import', [DepartmentController::class, 'import'])->name('departments.import');
    Route::resource('departments', DepartmentController::class);
    //################################### الوظائف ##################################
    Route::get('job_categories/export', [JobCategoryController::class, 'export'])->name('job_categories.export');
    Route::post('job_categories/import', [JobCategoryController::class, 'import'])->name('job_categories.import');
    Route::resource('job_categories', JobCategoryController::class);
    //################################### المؤهلات ##################################
    Route::get('qualifications/export', [QualificationController::class, 'export'])->name('qualifications.export');
    Route::post('qualifications/import', [QualificationController::class, 'import'])->name('qualifications.import');
    Route::resource('qualifications', QualificationController::class);
    //################################### فصيلة الدم ##################################
    Route::resource('bloodTypes', BloodTypeController::class);
    //################################### الجنسيات ##################################
    Route::get('nationalities/export', [NationalityController::class, 'export'])->name('nationalities.export');
    Route::post('nationalities/import', [NationalityController::class, 'import'])->name('nationalities.import');
    Route::resource('nationalities', NationalityController::class);
    //################################### المحافظات ##################################
    Route::get('governorates/export', [GovernorateController::class, 'export'])->name('governorates.export');
    Route::post('governorates/import', [GovernorateController::class, 'import'])->name('governorates.import');
    Route::resource('governorates', GovernorateController::class);
    //################################### المحافظات ##################################
    Route::get('cities/export', [CityController::class, 'export'])->name('cities.export');
    Route::post('cities/import', [CityController::class, 'import'])->name('cities.import');
    Route::resource('cities', CityController::class);
    //################################### الدرجات الوظيفية ##################################
    Route::resource('job_grades', JobGradeController::class);
    //################################### الانتهاء من الأعدادت #########################################

    //################################### شئون الموظفين ##################################
    //################################### أنواع الاضافى ##################################
    Route::get('additional_types/export', [AdditionalTypeController::class, 'export'])->name('additional_types.export');
    Route::post('additional_types/import', [AdditionalTypeController::class, 'import'])->name('additional_types.import');
    Route::resource('additional_types', AdditionalTypeController::class);
    //################################### أنواع البدلات ##################################
    Route::get('allowances/export', [AllowanceController::class, 'export'])->name('allowances.export');
    Route::post('allowances/import', [AllowanceController::class, 'import'])->name('allowances.import');
    Route::resource('allowances', AllowanceController::class);
    //################################### أنواع الخصومات ##################################
    Route::get('discount_types/export', [DiscountTypeController::class, 'export'])->name('discount_types.export');
    Route::post('discount_types/import', [DiscountTypeController::class, 'import'])->name('discount_types.import');
    Route::resource('discount_types', DiscountTypeController::class);
    //################################### الموظفين ##################################
    Route::get('employees/export', [EmployeeController::class, 'export'])->name('employees.export');
    Route::post('employees/import', [EmployeeController::class, 'import'])->name('employees.import');
    Route::get('employees/filter', [EmployeeController::class, 'filterEmploee'])->name('employees.filter');
    Route::resource('/employees', EmployeeController::class); // إذا كنت تريد استخدام resource
    Route::controller(EmployeeController::class)->prefix('/employees')->group(function () {
        Route::get('/get-governorates/{country}', 'getGovernorates')->name('get-governorates');

        Route::get('/get-cities/{governorate}', 'getCities')->name('get-cities');
        Route::post('/file-name', 'uploadFiles')->name('employees.upload-files');
    });
    Route::delete('/employees/upload-files/{id}', [EmployeeController::class, 'destroyUploadFiles'])->name('employees.upload-files.destroy');

    //################################### الأنتهاء من شئون الموظفين ##################################

    //################################### الاجور والمرتبات ##################################
    Route::controller(MainSalaryRecordController::class)->name('main_salary_records.')->prefix('/main_salary_records')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/open/month/create/{financeClnPeriod}', 'createOpen')->name('create-open');
        Route::get('/open/month/edit/{financeClnPeriod}', 'editOpen')->name('edit-open');
        Route::put('/edit/month/{financeClnPeriod}', 'editMonth')->name('edit-month');
        Route::put('/open/month/{financeClnPeriod}', 'openMonth')->name('open-month');
        Route::put('/close/month/{financeClnPeriod}', 'closeMonth')->name('close-month');
    });

    //################################### الجزاءات ##################################
    Route::controller(SalarySanctionsController::class)->name('sanctions.')->prefix('/sanctions')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/{financeClnPeriod}', 'create')->name('create');
        Route::post('/store/{financeClnPeriod}', 'store')->name('store');
        Route::get('/show/{financeClnPeriod}', 'show')->name('show');
        Route::get('/edit/{sanction}', 'edit')->name('edit');
        Route::get('/show/data/{sanction}', 'showData')->name('show-data');
        Route::patch('/update/{sanction}', 'update')->name('update');
        Route::delete('/delete/{sanction}', 'destroy')->name('destroy');
        Route::get('/sanctions/export/{slug}', 'export')->name('export');
        Route::post('/sanctions/import', 'import')->name('import');
        Route::post('/sanctions/print', 'print')->name('print');
    });

    //################################### الغيابات ##################################
    Route::controller(EmployeeSalaryAbsenceController::class)->name('absences.')->prefix('/absences')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/{financeClnPeriod}', 'create')->name('create');
        Route::post('/store/{financeClnPeriod}', 'store')->name('store');
        Route::get('/show/{financeClnPeriod}', 'show')->name('show');
        Route::get('/edit/{absence}', 'edit')->name('edit');
        Route::get('/show/data/{absence}', 'showData')->name('show-data');
        Route::patch('/update/{absence}', 'update')->name('update');
        Route::delete('/delete/{absence}', 'destroy')->name('destroy');
        Route::get('/absences/export/{slug}', 'export')->name('export');
        Route::post('/absences/import', 'import')->name('import');
        Route::post('/absences/print', 'print')->name('print');
    });

    //################################### أضافى أيام ##################################
    Route::controller(EmployeeSalaryAdditionalController::class)->name('additionals.')->prefix('/additionals')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/{financeClnPeriod}', 'create')->name('create');
        Route::post('/store/{financeClnPeriod}', 'store')->name('store');
        Route::get('/show/{financeClnPeriod}', 'show')->name('show');
        Route::get('/edit/{additional}', 'edit')->name('edit');
        Route::get('/show/data/{additional}', 'showData')->name('show-data');
        Route::patch('/update/{additional}', 'update')->name('update');
        Route::delete('/delete/{additional}', 'destroy')->name('destroy');
        Route::get('/additionals/export/{slug}', 'export')->name('export');
        Route::post('/additionals/import', 'import')->name('import');
        Route::post('/additionals/print', 'print')->name('print');
    });

    //################################### الأنتهاء من الاجور والمرتبات  ##################################

});