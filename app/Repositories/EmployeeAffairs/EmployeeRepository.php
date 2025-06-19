<?php

namespace App\Repositories\EmployeeAffairs;

use App\Models\Employee;
use App\Models\EmployeeFile;

use App\Enums\StatusActiveEnum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\EmployeeAffairs\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function getData()
    {
        $com_code = Auth::user()->com_code;
        $data = Employee::with(['createdBy:id,name', 'updatedBy:id,name'])->where('com_code', $com_code)->orderByDesc('id')->paginate(10);
        return $data;
    }

    public function storeData($request): Employee
    {
        try {
            DB::beginTransaction();
            $com_code =  Auth::user()->com_code;
            $active = StatusActiveEnum::ACTIVE;

            $lastEmployeeCode = Employee::orderByDesc('employee_code')->value('employee_code');
            $newEmployeeCode = $lastEmployeeCode ? $lastEmployeeCode + 1 : 1;
            $validateData = $request->validated();



            $dataInsert = array_merge($validateData, [
                'employee_code' => $newEmployeeCode,
                'com_code' => $com_code,
                'active' =>  $active,
                'created_by' => Auth::user()->id,
            ]);

            // إنشاء الموظف أولاً
            $employee = Employee::create($dataInsert);

            // ثم رفع الصورة إذا وجدت
            if ($request->hasFile('photo')) {
                $employee->addMediaFromRequest('photo')
                    ->toMediaCollection('photo');
            }

            if ($request->hasFile('cv')) {
                $employee->addMediaFromRequest('cv')
                    ->toMediaCollection('cv');
            }
            DB::commit();

            return $employee;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateData($request, Employee $employee): Employee
    {
        try {
            DB::beginTransaction();
            $com_code =  Auth::user()->com_code;
            $validateData = $request->validated();
            $dataUpdate = array_merge($validateData, [
                'com_code' => $com_code,
                'active' =>  $request->active,
                'updated_by' => Auth::user()->id,
            ]);
            if ($request->hasFile('photo')) {
                // Remove old photo if exists
                $employee->clearMediaCollection('photo');

                // Upload new photo
                $employee->addMediaFromRequest('photo')
                    ->toMediaCollection('photo');
            }

            if ($request->hasFile('cv')) {
                // Remove old cv if exists
                $employee->clearMediaCollection('cv');

                // Upload new cv
                $employee->addMediaFromRequest('cv')
                    ->toMediaCollection('cv');
            }
            DB::commit();

            // إنشاء الموظف أولاً
            $employee->update($dataUpdate);
            return  $employee;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


    public function deleteData(Employee $employee)
    {
        try {
            DB::beginTransaction();
            // حذف الملفات المرفوعة أولاً
            if ($employee->getFirstMedia('photo')) {
                $employee->clearMediaCollection('photo');
            }

            if ($employee->getFirstMedia('cv')) {
                $employee->clearMediaCollection('cv');
            }
            DB::commit();

            // ثم حذف سجل الموظف من قاعدة البيانات
            $employee->delete();
            return  $employee;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


    public function uploadFilesData($request): EmployeeFile
    {
        try {
            DB::beginTransaction();
            $com_code =  Auth::user()->com_code;
            $employeeFile = EmployeeFile::create([
                'employee_id' => $request->employee_id,
                'file_name' => $request->file_name,
                'com_code' => $com_code,
                'created_by' => Auth::user()->id
            ]);

            if ($request->hasFile('upload_file')) {
                $employeeFile->addMediaFromRequest('upload_file')->toMediaCollection('upload_file');
            }
            DB::commit();
            return $employeeFile;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function destroyUploadFilesData($id): EmployeeFile
    {
        try {
            DB::beginTransaction();
            $file = EmployeeFile::findOrFail($id);
            $file->clearMediaCollection('upload_file');
            $file->delete();
            DB::commit();
            return $file;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}