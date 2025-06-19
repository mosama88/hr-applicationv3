<?php

namespace App\Repositories\Interfaces;

use App\Models\Nationality;

interface NationalityRepositoryInterface
{
    public function getData();

    public function storeData($request): ?Nationality;

    public function updateData($request, Nationality $nationality);

    public function deleteData(Nationality $nationality);
    function searchNationalityForEmployee($request);
}