<?php

namespace App\Services\Settings;

use App\Models\Language;

use App\Repositories\Interfaces\Settings\LanguageRepositoryInterface;

class LanguageService
{

    public function __construct(protected LanguageRepositoryInterface $repository) {}

    public function index()
    {
        return $this->repository->getData();
    }

    public function store($request)
    {
        return $this->repository->storeData($request);
    }

    public function update($request, Language $language)
    {
        return $this->repository->updateData($request, $language);
    }

    public function destroy($language)
    {
        return $this->repository->deleteData($language);
    }

    function searchlanguage($request)
    {
        return $this->repository->searchlanguageForEmployee($request);
    }
}