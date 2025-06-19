<?php
namespace App\Repositories\Interfaces\EmployeeAffairs;

use App\Models\AdditionalType;

interface AdditionalTypeRepositoryInterface
{
    public function getData();

    public function storeData($request): ?AdditionalType;

    public function updateData($request, AdditionalType $additionalType);

    public function deleteData(AdditionalType $additionalType);

}