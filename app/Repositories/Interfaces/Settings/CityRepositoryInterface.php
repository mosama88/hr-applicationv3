<?php
namespace App\Repositories\Interfaces\Settings;

use App\Models\City;

interface CityRepositoryInterface
{
    public function getData();

    public function storeData($request): ?City;

    public function updateData($request, City $city);

    public function deleteData(City $city);

}