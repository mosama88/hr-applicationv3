<?php

namespace App\Repositories\Interfaces;

use App\Models\Branch;

interface BranchInterface
{
    public function getData();
    public function storeData($request): ?Branch;
    public function updateData($request, Branch $branch);
    public function deleteData(Branch $branch);
}