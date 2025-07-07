<?php

namespace App\Models;

use Spatie\Image\Enums\Fit;
use App\Enums\IsArchivedEnum;
use Spatie\Sluggable\HasSlug;
use EloquentFilter\Filterable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Salaries\IsAutoSalaryEnum;
use App\Enums\Salaries\SanctionTypeEnum;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class EmployeeSalarySanction extends Model implements HasMedia

{
    use HasFactory, Filterable, InteractsWithMedia, HasSlug;


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

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
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
        'sanctions_type' => SanctionTypeEnum::class,
        'is_archived' => IsArchivedEnum::class,
        'is_auto' => IsAutoSalaryEnum::class,
    ];
}