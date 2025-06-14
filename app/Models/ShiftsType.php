<?php

namespace App\Models;

use App\Enums\StatusActiveEnum;
use App\Enums\ShiftTypesEnum;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ShiftsType extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'shifts_types';

    protected $fillable = [
        'type',
        'slug',
        'from_time',
        'to_time',
        'total_hours',
        'active',
        'created_by',
        'updated_by',
        'com_code',
    ];


    public function getTypeLabelAttribute(): string
    {
        return $this->type->label();
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('type_label') // accessor
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
        'type' => ShiftTypesEnum::class,
        'active' => StatusActiveEnum::class
    ];
}