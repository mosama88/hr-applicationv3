<?php

namespace App\Providers;

use App\Repositories\BranchRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CurrencyRepository;
use App\Repositories\DepartmentRepository;
use App\Repositories\ShiftTypesRepository;
use App\Repositories\JobCategoryRepository;
use App\Repositories\QualificationRepository;
use App\Repositories\FinanceCalendarRepository;
use App\Repositories\Interfaces\BranchInterface;
use App\Repositories\AdminPanelSettingRepository;
use App\Repositories\Interfaces\CurrencyInterface;
use App\Repositories\Interfaces\DepartmentInterface;
use App\Repositories\Interfaces\ShiftTypesInterface;
use App\Repositories\Interfaces\JobCategoryInterface;
use App\Repositories\Interfaces\QualificationInterface;
use App\Repositories\Interfaces\FinanceCalendarInterface;
use App\Repositories\Interfaces\AdminPanelSettingInterface;

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
    }
}