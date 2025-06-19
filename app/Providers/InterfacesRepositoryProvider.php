<?php

namespace App\Providers;

use App\Repositories\CityRepository;
use App\Repositories\BranchRepository;
use App\Repositories\CountryRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CurrencyRepository;
use App\Repositories\JobGradeRepository;
use App\Repositories\LanguageRepository;
use App\Repositories\BloodTypeRepository;
use App\Repositories\DepartmentRepository;
use App\Repositories\ShiftTypesRepository;
use App\Repositories\GovernorateRepository;
use App\Repositories\JobCategoryRepository;
use App\Repositories\NationalityRepository;
use App\Repositories\QualificationRepository;
use App\Repositories\AdditionalTypeRepository;
use App\Repositories\FinanceCalendarRepository;
use App\Repositories\Interfaces\BranchInterface;
use App\Repositories\AdminPanelSettingRepository;
use App\Repositories\Interfaces\CurrencyInterface;
use App\Repositories\Interfaces\DepartmentInterface;
use App\Repositories\Interfaces\ShiftTypesInterface;
use App\Repositories\Interfaces\JobCategoryInterface;
use App\Repositories\Interfaces\QualificationInterface;
use App\Repositories\Interfaces\CityRepositoryInterface;
use App\Repositories\Interfaces\FinanceCalendarInterface;
use App\Repositories\Interfaces\AdminPanelSettingInterface;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\JobGradeRepositoryInterface;
use App\Repositories\Interfaces\LanguageRepositoryInterface;
use App\Repositories\Interfaces\BloodTypeRepositoryInterface;
use App\Repositories\Interfaces\GovernorateRepositoryInterface;
use App\Repositories\Interfaces\NationalityRepositoryInterface;
use App\Repositories\Interfaces\AdditionalTypeRepositoryInterface;

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
    }
}