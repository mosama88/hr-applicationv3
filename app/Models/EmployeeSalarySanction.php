<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSalarySanction extends Model
{
    use HasFactory;

    protected $table = 'employee_salary_sanctions';

    protected $fillable = [
        'main_salary_employee_id',
        'finance_cln_period_id',
        'is_auto',
        'employee_code',
        'day_price',
        'sanctions_type',
        'value',
        'total',
        'is_archived',
        'archived_by',
        'archived_date',
        'notes',
        'active',
        'com_code',
        'created_by',
        'updated_by'
    ];


    public function mainSalaryEmployee()
    {
        return $this->belongsTo(MainSalaryEmployee::class, 'main_salary_employee_id');
    }

    public function financeClnPeriod()
    {
        return $this->belongsTo(FinanceClnPeriod::class, 'finance_cln_period_id');
    }


    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_code');
    }

    public function archivedBy()
    {
        return $this->belongsTo(Admin::class, 'archived_by');
    }
    
    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }
}