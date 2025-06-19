<?php

namespace App\Services\Settings;
use App\Models\Country;

use App\Repositories\Interfaces\Settings\CountryRepositoryInterface;

class CountryService
{

    public function __construct(protected CountryRepositoryInterface $repository)
    {

    }

    public function index()
    {
        return $this->repository->getData();
    }

      public function store($request)
    {
        return $this->repository->storeData($request);
    }

   public function update($request, Country $country)
    {
        return $this->repository->updateData($request, $country);
    }

    public function destroy($country)
    {
        return $this->repository->deleteData($country);
    }
    
    public function searchCountry($request)
    {
        return $this->repository->searchCountryForEmployee($request);
    }
}