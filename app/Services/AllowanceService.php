<?php

namespace App\Services;
use App\Models\Allowance;

use App\Repositories\Interfaces\AllowanceRepositoryInterface;

class AllowanceService
{

    public function __construct(protected AllowanceRepositoryInterface $repository)
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

   public function update($request, Allowance $allowance)
    {
        return $this->repository->updateData($request, $allowance);
    }

    public function destroy($allowance)
    {
        return $this->repository->deleteData($allowance);
    }
}