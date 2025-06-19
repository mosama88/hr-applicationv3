<?php
namespace App\Repositories\Interfaces;

use App\Models\Governorate;

interface GovernorateRepositoryInterface
{
    public function getData();

    public function storeData($request): ?Governorate;

    public function updateData($request, Governorate $governorate);

    public function deleteData(Governorate $governorate);

}
