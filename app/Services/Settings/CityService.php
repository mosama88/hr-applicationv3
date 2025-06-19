<?php

namespace App\Services\Settings;
use App\Models\City;

use App\Repositories\Interfaces\Settings\CityRepositoryInterface;

class CityService
{

    public function __construct(protected CityRepositoryInterface $repository)
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

   public function update($request, City $city)
    {
        return $this->repository->updateData($request, $city);
    }

    public function destroy($city)
    {
        return $this->repository->deleteData($city);
    }
}