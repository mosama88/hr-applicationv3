<?php

namespace App\Models;

use App\Enums\IsArchivedEnum;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Enums\IsStoppedSalaryEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MainSalaryEmployee extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'main_salary_employees';

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('finance_yr')
            ->saveSlugsTo('slug');
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $fillable = [
        'finance_cln_period_id',
        'financial_year',
        'year_month',
        'employee_code',
        'employee_name',
        'slug',
        'salary',
        'day_price',
        'branch_id',
        'functional_status',
        'department_code',
        'job_category_id',
        'total_rewards_salary',
        'motivation_type',
        'additional_days_counter',
        'additional_days_total',
        'fixed_allowances',
        'changeable_allowance',
        'total_benefits',
        'sanctions_days_counter',
        'sanctions_days_total',
        'absence_days_counter',
        'absence_days_total',
        'monthly_loan',
        'permanent_loan',
        'discount',
        'phones_bill',
        'medical_insurance_monthly',
        'medical_social_monthly',
        'total_deductions',
        'net_salary',
        'net_salary_after_close_for_deportation',
        'archive_by',
        'is_archived',
        'archived_date',
        'last_salary_remain_balance',
        'last_main_salary_record_id',
        'is_take_action_disbursed_collect',
        'type_salary_receipt',
        'is_sensitive_manager_data',
        'is_stopped',
        'com_code',
        'created_by',
        'updated_by'

    ];


    public function FinanceClnCalendar()
    {
        return $this->belongsTo(FinanceClnPeriod::class, 'finance_cln_period_id');
    }

    public function financeCalendar()
    {
        return $this->belongsTo(FinanceCalendar::class, 'financial_year');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_code', 'employee_code');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
    
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_code');
    }

    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    public function archiveBy()
    {
        return $this->belongsTo(Admin::class, 'archive_by');
    }

    protected $casts = [
        'is_stopped' => IsStoppedSalaryEnum::class,
        'is_archived' => IsArchivedEnum::class,
    ];
}