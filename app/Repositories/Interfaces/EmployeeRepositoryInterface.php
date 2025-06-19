<?php

namespace App\Repositories\Interfaces;

use App\Models\Employee;
use App\Models\EmployeeFile;

interface EmployeeRepositoryInterface
{
    public function getData();

    public function storeData($request): ?Employee;

    public function updateData($request, Employee $employee);

    public function deleteData(Employee $employee);

    public function uploadFilesData($request): EmployeeFile;
    
    public function destroyUploadFilesData($id): EmployeeFile;
}