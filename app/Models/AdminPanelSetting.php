<?php

namespace App\Models;

use Spatie\Image\Enums\Fit;
use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use App\Enums\PanelSettingSystemStatusEnum;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AdminPanelSetting extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasSlug;

    protected $table = 'admin_panel_settings';

    protected $fillable = [
        'company_name',
        'system_status',
        'slug',
        'mobile',
        'address',
        'email',
        'max_hours_take_fp_as_addtional',
        'less_than_minute_neglecting_fp',
        'after_minute_calculate_delay',
        'after_minute_calculate_early_departure',
        'after_minute_quarterday',
        'after_time_half_daycut',
        'after_time_allday_daycut',
        'monthly_vacation_balance',
        'after_days_begin_vacation',
        'first_balance_begin_vacation',
        'sanctions_value_first_absence',
        'sanctions_value_second_absence',
        'sanctions_value_thaird_absence',
        'sanctions_value_forth_absence',
        'created_by',
        'updated_by',
        'com_code',

    ];


    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('company_name')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
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
        'system_status' => PanelSettingSystemStatusEnum::class,
    ];
}