<?php

namespace App\Services\Settings;
use App\Models\Governorate;

use App\Repositories\Interfaces\Settings\GovernorateRepositoryInterface;

class GovernorateService
{

    public function __construct(protected GovernorateRepositoryInterface $repository)
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

   public function update($request, Governorate $governorate)
    {
        return $this->repository->updateData($request, $governorate);
    }

    public function destroy($governorate)
    {
        return $this->repository->deleteData($governorate);
    }
}