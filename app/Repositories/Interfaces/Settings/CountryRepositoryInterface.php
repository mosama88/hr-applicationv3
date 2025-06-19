<?php

namespace App\Repositories\Interfaces\Settings;

use App\Models\Country;

interface CountryRepositoryInterface
{
    public function getData();

    public function storeData($request): ?Country;

    public function updateData($request, Country $country);

    public function deleteData(Country $country);

    public function searchCountryForEmployee($request);
}