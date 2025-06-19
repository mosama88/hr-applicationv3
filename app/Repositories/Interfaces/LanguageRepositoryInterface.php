<?php

namespace App\Repositories\Interfaces;

use App\Models\Language;

interface LanguageRepositoryInterface
{
    public function getData();

    public function storeData($request): ?Language;

    public function updateData($request, Language $language);

    public function deleteData(Language $language);

    public function searchlanguageForEmployee($request);
}