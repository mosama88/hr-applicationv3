<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class EmployeeSalaryAbsenceFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function name($value)
    {
        return $this->whereHas('mainSalaryEmployee', function ($q) use ($value) {
            $q->where('employee_name', 'like', '%' . $value . '%');
        });
    }


    public function employeeCodeSearch($value)
    {
        return $this->whereLike('employee_code', '%' . $value . '%');
    }

    public function department($value)
    {
        return $this->whereHas('mainSalaryEmployee.department', function ($q) use ($value) {
            $q->where('name', 'like', '%' . $value . '%');
        });
    }


    public function branch($value)
    {
        return $this->whereHas('mainSalaryEmployee.branch', function ($q) use ($value) {
            $q->where('name', 'like', '%' . $value . '%');
        });
    }

    

    public function daysAbsences($value)
    {
        return $this->where('value', $value);
    }


}