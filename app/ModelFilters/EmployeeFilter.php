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


    public function nationality($value)
    {
        return $this->where(function ($query) use ($value) {
            $query->whereLike('nationality_id', $value);
        });
    }
}