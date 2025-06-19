<?php
namespace App\Repositories\Interfaces\EmployeeAffairs;

use App\Models\Allowance;

interface AllowanceRepositoryInterface
{
    public function getData();

    public function storeData($request): ?Allowance;

    public function updateData($request, Allowance $allowance);

    public function deleteData(Allowance $allowance);

}