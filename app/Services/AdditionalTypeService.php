<?php

namespace App\Services;
use App\Models\AdditionalType;

use App\Repositories\Interfaces\AdditionalTypeRepositoryInterface;

class AdditionalTypeService
{

    public function __construct(protected AdditionalTypeRepositoryInterface $repository)
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

   public function update($request, AdditionalType $additionalType)
    {
        return $this->repository->updateData($request, $additionalType);
    }

    public function destroy($additionalType)
    {
        return $this->repository->deleteData($additionalType);
    }
}