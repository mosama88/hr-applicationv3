<?php

namespace App\Models;

use App\Enums\IsArchivedEnum;
use Spatie\Sluggable\HasSlug;
use EloquentFilter\Filterable;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Salaries\IsAutoSalaryEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\PermanentLoan\PermanentLoanhasParentDisbursedDoneEnum;


class EmployeeSalaryPermanentLoan extends Model
{
    use HasFactory, Filterable, HasSlug;


    protected $table = 'employee_salary_permanent_loans';

    protected $fillable = [
        'employee_code',
        'slug',
        'employee_salary',
        'total',
        'month_number_installment',
        'month_installment_value',
        'year_month_start',
        'year_month_start_date',
        'installment_paid',
        'installment_remain',
        'notes',
        'has_disbursed_done',
        'disbursed_by',
        'disbursed_at',
        'is_archived',
        'archived_by',
        'archived_date',
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
        return $this->belongsTo(MainSalaryEmployee::class, 'employee_code', 'employee_code');
    }


    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function departmentCode()
    {
        return $this->belongsTo(Department::class);
    }

    public function financeClnPeriod()
    {
        return $this->belongsTo(FinanceClnPeriod::class, 'finance_cln_period_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_code', 'employee_code');
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
        'has_disbursed_done' => PermanentLoanhasParentDisbursedDoneEnum::class,
    ];
}