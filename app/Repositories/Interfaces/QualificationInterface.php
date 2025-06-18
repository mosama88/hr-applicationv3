<?php

namespace App\Repositories\Interfaces;

use App\Models\Qualification;

interface QualificationInterface
{
    public function getData();
    public function storeData($request): ?Qualification;
    public function updateData($request, Qualification $qualification);
    public function deleteData(Qualification $qualification);
    public function searchQualification($request);
}
