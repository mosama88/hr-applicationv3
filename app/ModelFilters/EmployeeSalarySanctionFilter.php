<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class EmployeeSalarySanctionFilter extends ModelFilter
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

    public function sanctionTypes($value)
    {
        return $this->where('sanctions_type', $value);
    }

    public function daysSanctions($value)
    {
        return $this->where('value', $value);
    }
}
