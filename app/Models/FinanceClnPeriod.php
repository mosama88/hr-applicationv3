<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\FinanceClnPeriodsIsOpen;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class FinanceClnPeriod extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'finance_cln_periods';
    protected $fillable = [
        'finance_calendar_id',
        'number_of_days',
        'year_and_month',
        'finance_yr',
        'start_date_m',
        'end_date_m',
        'is_open',
        'start_date_fp',
        'end_date_fp',
        'created_by',
        'updated_by',
        'com_code',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('year_and_month')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function FinanceCalendar()
    {
        return $this->belongsTo(FinanceCalendar::class, 'finance_calendar_id');
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
        'is_open' => FinanceClnPeriodsIsOpen::class,
        'period_date' => 'date',
    ];
}