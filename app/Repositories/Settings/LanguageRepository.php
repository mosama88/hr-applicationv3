<?php

namespace App\Repositories\Settings;

use Illuminate\Support\Facades\Auth;
use App\Enums\StatusActiveEnum;

use App\Models\Language;
use App\Repositories\Interfaces\Settings\LanguageRepositoryInterface;

class LanguageRepository implements LanguageRepositoryInterface
{
    public function getData()
    {
        $com_code = Auth::user()->com_code;
        $data = Language::with(['createdBy:id,name', 'updatedBy:id,name'])->where('com_code', $com_code)->orderByDesc('id')->paginate(10);
        return $data;
    }

    public function storeData($request): Language
    {
        $com_code =  Auth::user()->com_code;
        $active = StatusActiveEnum::ACTIVE;
        $dataValidate = $request->validated();
        $dataInsert = array_merge($dataValidate, [
            'created_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $active,
        ]);

        return Language::create($dataInsert);
    }

    public function updateData($request, Language $language): Language
    {

        $com_code =  Auth::user()->com_code;
        $dataValidate = $request->validated();
        $dataUpdate = array_merge($dataValidate, [
            'updated_by' => Auth::user()->id,
            'com_code' => $com_code,
            'active' =>  $request->active,
        ]);

        $language->update($dataUpdate);
        return  $language;
    }


    public function deleteData(Language $language)
    {
        $language->delete();
        return  $language;
    }

    function searchlanguageForEmployee($request)
    {
        $languages = Language::where('name', 'LIKE', "%{$request->q}%")->limit(5)->get();
        return $languages;
    }
}