<?php
namespace App\Repositories\Interfaces;

use App\Models\Employee;

interface EmployeeRepositoryInterface
{
    public function getData();

    public function storeData($request): ?Employee;

    public function updateData($request, Employee $employee);

    public function deleteData(Employee $employee);

}
