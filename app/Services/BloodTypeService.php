<?php

namespace App\Services;

use App\Models\BloodType;
use App\Repositories\Interfaces\BloodTypeRepositoryInterface;

class BloodTypeService
{

    public function __construct(protected BloodTypeRepositoryInterface $repository)
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

   public function update($request, BloodType $bloodType)
    {
        return $this->repository->updateData($request, $bloodType);
    }

    public function destroy($bloodType)
    {
        return $this->repository->deleteData($bloodType);
    }
}