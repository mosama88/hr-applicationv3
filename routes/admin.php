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
    Route::resource('branches', BranchController::class);
    //################################### الشفتات ##################################
    Route::resource('shiftTypes', ShiftTypesController::class);
    //################################### الدول ##################################
    Route::resource('countries', CountryController::class);
    //################################### اللغات ##################################
    Route::resource('languages', LanguageController::class);
    //################################### العملات ##################################
    Route::resource('currencies', CurrencyController::class);
    //################################### الادارات ##################################
    Route::resource('departments', DepartmentController::class);
    //################################### الوظائف ##################################
    Route::resource('job_categories', JobCategoryController::class);
    //################################### المؤهلات ##################################
    Route::resource('qualifications', QualificationController::class);
    //################################### فصيلة الدم ##################################
    Route::resource('bloodTypes', BloodTypeController::class);
    //################################### الجنسيات ##################################
    Route::resource('nationalities', NationalityController::class);
    //################################### المحافظات ##################################
    Route::resource('governorates', GovernorateController::class);
    //################################### المحافظات ##################################
    Route::resource('cities', CityController::class);
    //################################### الدرجات الوظيفية ##################################
    Route::resource('job_grades', JobGradeController::class);
    //################################### الانتهاء من الأعدادت #########################################

    //################################### شئون الموظفين ##################################
    //################################### أنواع الاضافى ##################################
    Route::resource('additional_types', AdditionalTypeController::class);
    //################################### أنواع البدلات ##################################
    Route::resource('allowances', AllowanceController::class);
    //################################### أنواع الخصومات ##################################
    Route::resource('discount_types', DiscountTypeController::class);
    //################################### الموظفين ##################################
    Route::resource('/employees', EmployeeController::class); // إذا كنت تريد استخدام resource
    Route::get('/filter', [EmployeeController::class, 'filterEmploee'])->name('employees.filter');
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
        Route::match(['put', 'patch'], '/update/{slug}', 'update')->name('update');
        Route::delete('/delete/{sanction}', 'destroy')->name('destroy');
        Route::get('/sanctions/export/{slug}', 'export')->name('export');
    });


    //################################### الأنتهاء من الاجور والمرتبات  ##################################

});