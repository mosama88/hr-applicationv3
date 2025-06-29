<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Settings\CityController;
use App\Http\Controllers\Dashboard\Settings\CountryController;
use App\Http\Controllers\Dashboard\Settings\CurrencyController;
use App\Http\Controllers\Dashboard\Settings\LanguageController;
use App\Http\Controllers\Dashboard\Settings\DepartmentController;
use App\Http\Controllers\Dashboard\Settings\JobCategoryController;
use App\Http\Controllers\Dashboard\Settings\NationalityController;
use App\Http\Controllers\Dashboard\Settings\QualificationController;
use App\Http\Controllers\Dashboard\Salaries\SalarySanctionsController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');





Route::get('country/searchCountry', [CountryController::class, 'searchCountry'])->name('dashboard.countries.searchCountry');
Route::get('currency/searchCurrency', [CurrencyController::class, 'searchCurrency'])->name('dashboard.currencies.searchCurrency');
Route::get('nationality/searchNationality', [NationalityController::class, 'searchNationality'])->name('dashboard.nationalities.searchNationality');
Route::get('language/searchlanguage', [LanguageController::class, 'searchlanguage'])->name('dashboard.languages.searchlanguage');
Route::get('qualifications/searchQualification', [QualificationController::class, 'searchQualification'])->name('dashboard.qualifications.searchQualification');
Route::get('departments/searchDepartment', [DepartmentController::class, 'searchDepartment'])->name('dashboard.departments.searchDepartment');
Route::get('job_categories/searchJob_category', [JobCategoryController::class, 'searchJob_category'])->name('dashboard.job_categories.searchJob_category');
Route::get('cities/searchCity', [CityController::class, 'searchCity'])->name('dashboard.cities.searchCity');
Route::get('employees/searchEmployee', [SalarySanctionsController::class, 'searchEmployee'])->name('dashboard.sanctions.search_employee');



Route::get('/get-day-price/{id}', [SalarySanctionsController::class, 'getDayPrice'])->name('get.day.price');