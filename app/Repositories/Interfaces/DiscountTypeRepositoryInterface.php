<?php
namespace App\Repositories\Interfaces;

use App\Models\DiscountType;

interface DiscountTypeRepositoryInterface
{
    public function getData();

    public function storeData($request): ?DiscountType;

    public function updateData($request, DiscountType $discountType);

    public function deleteData(DiscountType $discountType);

}
