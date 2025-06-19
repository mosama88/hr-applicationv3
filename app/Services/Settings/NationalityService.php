<?php

namespace App\Services\Settings;

use App\Models\Nationality;

use App\Repositories\Interfaces\Settings\NationalityRepositoryInterface;

class NationalityService
{

    public function __construct(protected NationalityRepositoryInterface $repository) {}

    public function index()
    {
        return $this->repository->getData();
    }

    public function store($request)
    {
        return $this->repository->storeData($request);
    }

    public function update($request, Nationality $nationality)
    {
        return $this->repository->updateData($request, $nationality);
    }

    public function destroy($nationality)
    {
        return $this->repository->deleteData($nationality);
    }

    public function searchNationality($request)
    {
        return $this->repository->searchNationalityForEmployee($request);
    }
}