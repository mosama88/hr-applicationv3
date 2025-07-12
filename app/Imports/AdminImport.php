<?php

namespace App\Imports;

use App\Models\Admin;
use App\Enums\AdminGenderEnum;
use App\Enums\StatusActiveEnum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class AdminImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $genderValue = $this->parseGenderType($row[4]);
        if (is_null($genderValue)) {
            throw new \Exception("نوع الجنس غير صالح أو غير معروف: {$row[4]}");
        }
        return new Admin([
            'name' => $row[0],
            'username' => $row[1],
            'email' => $row[2],
            'mobile' => $row[3],
            'gender' => AdminGenderEnum::from($genderValue),
            'password' => Hash::make('password'),
            'active' => StatusActiveEnum::ACTIVE,
            'created_by' => Auth::user()->id,
            'com_code' => Auth::user()->com_code,
        ]);
    }

    protected function parseGenderType($value): ?int
    {
        $map = [
            'ذكر' => 1,
            'انثى' => 2,
        ];

        $value = trim($value);
        return $map[$value] ?? null;
    }
}