<?php

namespace App\Models;

use App\Enums\YesOrNoEnum;
use Spatie\Sluggable\HasSlug;
use App\Enums\AdminGenderEnum;
use EloquentFilter\Filterable;
use App\Enums\StatusActiveEnum;
use App\Enums\Employee\Military;
use Spatie\Sluggable\SlugOptions;
use App\Enums\Employee\ReligionEnum;
use App\Enums\Employee\SocialStatus;
use App\Enums\Employee\MotivationType;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Employee\FunctionalStatus;
use App\Enums\Employee\TypeSalaryReceipt;
use App\Enums\Employee\DrivingLicenseType;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Enums\Employee\GraduationEstimateEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class Employee extends Model implements HasMedia
{
    use HasFactory, Filterable, HasSlug, InteractsWithMedia;

    protected $table = 'employees';

    protected $fillable = [
        'employee_code',
        'fp_code',
        'name',
        'slug',
        'gender',
        'branch_id',
        'job_grade_id',
        'qualification_id',
        'qualification_year',
        'major',
        'graduation_estimate',
        'birth_date',
        'national_id',
        'end_national_id',
        'national_id_place',
        'blood_type_id',
        'religion',
        'language_id',
        'email',
        'country_id',
        'governorate_id',
        'city_id',
        'home_telephone',
        'mobile',
        'address',
        'military',
        'military_service_start_date',
        'military_service_end_date',
        'military_wepon',
        'military_exemption_date',
        'military_exemption_reason',
        'military_postponement_reason',
        'date_resignation',
        'resignation_reason',
        'driving_license',
        'driving_license_type',
        'driving_License_id',
        'has_relatives',
        'relatives_details',
        'notes',
        'hiring_date',
        'functional_status',
        'department_id',
        'job_category_id',
        'has_attendance',
        'has_fixed_shift',
        'shifts_type_id',
        'daily_work_hour',
        'salary',
        'day_price',
        'currency_id',
        'bank_number_account',
        'motivation_type',
        'motivation_value',
        'has_social_insurance',
        'social_insurance_cut_monthely',
        'social_insurance_number',
        'has_medical_insurance',
        'medical_insurance_cut_monthely',
        'medical_insurance_number',
        'type_salary_receipt',
        'has_vacation_balance',
        'urgent_person_details',
        'children_number',
        'social_status',
        'has_disabilities',
        'disabilities_details',
        'nationality_id',
        'pasport_identity',
        'pasport_exp_date',
        'has_fixed_allowances',
        'is_done_Vacation_formula',
        'is_Sensitive_manager_data',
        'active',
        'created_by',
        'updated_by',
        'com_code'
    ];


    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('photo')->singleFile();
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function employeeFile()
    {
        return $this->hasMany(EmployeeFile::class);
    }


    protected static function booted()
    {
        static::deleting(function ($employee) {
            foreach ($employee->employeeFile as $file) {
                $file->clearMediaCollection('upload_file');
                $file->delete();
            }
        });
    }



    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }


    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function jobGrade()
    {
        return $this->belongsTo(JobGrade::class, 'job_grade_id');
    }
    public function qualification()
    {
        return $this->belongsTo(Qualification::class, 'qualification_id');
    }

    public function bloodType()
    {
        return $this->belongsTo(BloodType::class, 'blood_type_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class, 'governorate_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function jobCategory()
    {
        return $this->belongsTo(JobCategory::class, 'job_category_id');
    }

    public function shiftsType()
    {
        return $this->belongsTo(ShiftsType::class, 'shifts_type_id');
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }



    protected $casts = [
        'gender' => AdminGenderEnum::class,
        'active' => StatusActiveEnum::class,
        'driving_license_type' => DrivingLicenseType::class,
        'functional_status' => FunctionalStatus::class,
        'graduation_estimate' => GraduationEstimateEnum::class,
        'military' => Military::class,
        'motivation_type' => MotivationType::class,
        'religion' => ReligionEnum::class,
        'social_status' => SocialStatus::class,
        'type_salary_receipt' => TypeSalaryReceipt::class,
        'driving_license' => YesOrNoEnum::class,
        'has_relatives' => YesOrNoEnum::class,
        'has_attendance' => YesOrNoEnum::class,
        'has_fixed_shift' => YesOrNoEnum::class,
        'has_social_insurance' => YesOrNoEnum::class,
        'has_medical_insurance' => YesOrNoEnum::class,
        'has_vacation_balance' => YesOrNoEnum::class,
        'has_disabilities' => YesOrNoEnum::class,
        'has_fixed_allowances' => YesOrNoEnum::class,
    ];
}