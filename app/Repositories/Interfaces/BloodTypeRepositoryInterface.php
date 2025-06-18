<?php

namespace App\Repositories\Interfaces;

use App\Models\BloodType;

interface BloodTypeRepositoryInterface
{
    public function getData();

    public function storeData($request): ?BloodType;

    public function updateData($request, BloodType $bloodType);

    public function deleteData(BloodType $bloodType);
}
