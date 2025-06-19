<?php

namespace App\Services;
use App\Models\DiscountType;

use App\Repositories\Interfaces\DiscountTypeRepositoryInterface;

class DiscountTypeService
{

    public function __construct(protected DiscountTypeRepositoryInterface $repository)
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

   public function update($request, DiscountType $discountType)
    {
        return $this->repository->updateData($request, $discountType);
    }

    public function destroy($discountType)
    {
        return $this->repository->deleteData($discountType);
    }
}