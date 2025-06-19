<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Settings\CityRepository;
use App\Repositories\Settings\BranchRepository;
use App\Repositories\Settings\CountryRepository;
use App\Repositories\Settings\CurrencyRepository;
use App\Repositories\EmployeeAffairs\EmployeeRepository;
use App\Repositories\Settings\JobGradeRepository;
use App\Repositories\Settings\LanguageRepository;
use App\Repositories\EmployeeAffairs\AllowanceRepository;
use App\Repositories\Settings\BloodTypeRepository;
use App\Repositories\Settings\DepartmentRepository;
use App\Repositories\Settings\ShiftTypesRepository;
use App\Repositories\Settings\GovernorateRepository;
use App\Repositories\Settings\JobCategoryRepository;
use App\Repositories\Settings\NationalityRepository;
use App\Repositories\EmployeeAffairs\DiscountTypeRepository;
use App\Repositories\Settings\QualificationRepository;
use App\Repositories\EmployeeAffairs\AdditionalTypeRepository;
use App\Repositories\Settings\FinanceCalendarRepository;
use App\Repositories\Interfaces\Settings\BranchInterface;
use App\Repositories\Settings\AdminPanelSettingRepository;
use App\Repositories\Interfaces\Settings\CurrencyInterface;
use App\Repositories\Interfaces\Settings\DepartmentInterface;
use App\Repositories\Interfaces\Settings\ShiftTypesInterface;
use App\Repositories\Interfaces\Settings\JobCategoryInterface;
use App\Repositories\Interfaces\Settings\QualificationInterface;
use App\Repositories\Interfaces\Settings\CityRepositoryInterface;
use App\Repositories\Interfaces\Settings\FinanceCalendarInterface;
use App\Repositories\Interfaces\Settings\AdminPanelSettingInterface;
use App\Repositories\Interfaces\Settings\CountryRepositoryInterface;
use App\Repositories\Interfaces\Settings\JobGradeRepositoryInterface;
use App\Repositories\Interfaces\Settings\LanguageRepositoryInterface;
use App\Repositories\Interfaces\Settings\BloodTypeRepositoryInterface;
use App\Repositories\Interfaces\Settings\GovernorateRepositoryInterface;
use App\Repositories\Interfaces\Settings\NationalityRepositoryInterface;
use App\Repositories\Interfaces\EmployeeAffairs\EmployeeRepositoryInterface;
use App\Repositories\Interfaces\EmployeeAffairs\AllowanceRepositoryInterface;
use App\Repositories\Interfaces\EmployeeAffairs\DiscountTypeRepositoryInterface;
use App\Repositories\Interfaces\EmployeeAffairs\AdditionalTypeRepositoryInterface;

class InterfacesRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        app()->bind(AdminPanelSettingInterface::class, AdminPanelSettingRepository::class);
        app()->bind(FinanceCalendarInterface::class, FinanceCalendarRepository::class);
        app()->bind(BranchInterface::class, BranchRepository::class);
        app()->bind(ShiftTypesInterface::class, ShiftTypesRepository::class);
        app()->bind(CurrencyInterface::class, CurrencyRepository::class);
        app()->bind(DepartmentInterface::class, DepartmentRepository::class);
        app()->bind(JobCategoryInterface::class, JobCategoryRepository::class);
        app()->bind(QualificationInterface::class, QualificationRepository::class);
        app()->bind(BloodTypeRepositoryInterface::class, BloodTypeRepository::class);
        app()->bind(NationalityRepositoryInterface::class, NationalityRepository::class);
        app()->bind(LanguageRepositoryInterface::class, LanguageRepository::class);
        app()->bind(CountryRepositoryInterface::class, CountryRepository::class);
        app()->bind(GovernorateRepositoryInterface::class, GovernorateRepository::class);
        app()->bind(CityRepositoryInterface::class, CityRepository::class);
        app()->bind(JobGradeRepositoryInterface::class, JobGradeRepository::class);
        app()->bind(AdditionalTypeRepositoryInterface::class, AdditionalTypeRepository::class);
        app()->bind(AllowanceRepositoryInterface::class, AllowanceRepository::class);
        app()->bind(DiscountTypeRepositoryInterface::class, DiscountTypeRepository::class);
        app()->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
    }
}