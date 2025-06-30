<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class EmployeeFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function employeeSearch($value)
    {
        return $this->where(function ($query) use ($value) {
            $query->whereLike('name', '%' . $value . '%')->orWhereLike('national_id', '%' . $value . '%');
        });
    }

    public function fpCodeSearch($value)
    {
        return $this->where(function ($query) use ($value) {
            $query->whereLike('fp_code', '%' . $value . '%');
        });
    }
    
    public function employeeCodeSearch($value)
    {
        return $this->where(function ($query) use ($value) {
            $query->whereLike('employee_code', '%' . $value . '%');
        });
    }

    public function branch($value)
    {
        return $this->where(function ($query) use ($value) {
            $query->whereLike('branch_id', $value);
        });
    }

    public function gender($value)
    {
        return $this->where(function ($query) use ($value) {
            $query->whereLike('gender', '%' . $value . '%');
        });
    }

    public function socialStatus($value)
    {
        return $this->where(function ($query) use ($value) {
            $query->whereLike('social_status', '%' . $value . '%');
        });
    }

    public function mobile($value)
    {
        return $this->where(function ($query) use ($value) {
            $query->whereLike('mobile', '%' . $value . '%');
        });
    }


    public function nationality($value)
    {
        return $this->where(function ($query) use ($value) {
            $query->where('nationality_id',  $value);
        });
    }

    public function religion($value)
    {
        return $this->where(function ($query) use ($value) {
            $query->where('religion',  $value);
        });
    }

    public function military($value)
    {
        return $this->where(function ($query) use ($value) {
            $query->where('military',  $value);
        });
    }
    public function functionalStatus($value)
    {
        return $this->where(function ($query) use ($value) {
            $query->where('functional_status',  $value);
        });
    }


    public function country($value)
    {
        return $this->where(function ($query) use ($value) {
            $query->where('country_id', $value);
        });
    }


    public function governorate($value)
    {
        return $this->where(function ($query) use ($value) {
            $query->where('governorate_id', $value);
        });
    }

    public function city($value)
    {
        return $this->where(function ($query) use ($value) {
            $query->where('city_id', $value);
        });
    }

    public function jobGrade($value)
    {
        return $this->where(function ($query) use ($value) {
            $query->where('job_grade_id', $value);
        });
    }

    public function department($value)
    {
        return $this->where(function ($query) use ($value) {
            $query->where('department_id', $value);
        });
    }

    public function jobCategory($value)
    {
        return $this->where(function ($query) use ($value) {
            $query->where('job_category_id', $value);
        });
    }

    public function shiftsType($value)
    {
        return $this->where(function ($query) use ($value) {
            $query->where('shifts_type_id', $value);
        });
    }

    public function currency($value)
    {
        return $this->where(function ($query) use ($value) {
            $query->where('currency_id', $value);
        });
    }

    public function typeSalaryReceipt($value)
    {
        return $this->where(function ($query) use ($value) {
            $query->where('type_salary_receipt', $value);
        });
    }

    public function active($value)
    {
        return $this->where(function ($query) use ($value) {
            $query->where('active', $value);
        });
    }
}