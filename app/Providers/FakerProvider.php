<?php

namespace App\Providers;

use App\Faker\CityFaker;
use App\Faker\CountryFaker;
use App\Faker\CurrencyFaker;
use App\Faker\LanguageFaker;
use App\Faker\DepartmentFaker;
use App\Faker\GovernorateFaker;
use App\Faker\JobCategoryFaker;
use App\Faker\NationalityFaker;
use App\Faker\QualificationFaker;
use Illuminate\Support\ServiceProvider;

class FakerProvider extends ServiceProvider
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
        fake()->addProvider(new CountryFaker(fake()));
        fake()->addProvider(new LanguageFaker(fake()));
        fake()->addProvider(new CurrencyFaker(fake()));
        fake()->addProvider(new DepartmentFaker(fake()));
        fake()->addProvider(new QualificationFaker(fake()));
        fake()->addProvider(new NationalityFaker(fake()));
        fake()->addProvider(new GovernorateFaker(fake()));
        fake()->addProvider(new CityFaker(fake()));
        fake()->addProvider(new JobCategoryFaker(fake()));
    }
}