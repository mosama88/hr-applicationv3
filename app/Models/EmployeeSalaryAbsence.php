<?php

namespace App\Models;

use App\Enums\IsArchivedEnum;
use Spatie\Sluggable\HasSlug;
use EloquentFilter\Filterable;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Salaries\IsAutoSalaryEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeSalaryAbsence extends Model

{
    use HasFactory, Filterable, HasSlug;


    protected $table = 'employee_salary_absence_days';

    protected $fillable = [
        'main_salary_employee_id',
        'finance_cln_period_id',
        'is_auto',
        'employee_code',
        'day_price',
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

    public function getEmployeeNameForSlugAttribute(): string
    {
        return $this->mainSalaryEmployee?->employee_name ?? '';
    }


    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('employee_name_for_slug')
            ->saveSlugsTo('slug');
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }


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

    protected $casts = [
        'is_archived' => IsArchivedEnum::class,
        'is_auto' => IsAutoSalaryEnum::class,
    ];
}