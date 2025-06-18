<?php

namespace App\Repositories\Interfaces;

use App\Models\Department;

interface DepartmentInterface
{
    public function getData();
    public function storeData($request): ?Department;
    public function updateData($request, Department $department);
    public function deleteData(Department $department);
    public function searchDepartmentForEmployee($request);
}