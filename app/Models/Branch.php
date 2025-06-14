<?php

namespace App\Models;

use App\Enums\StatusActiveEnum;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Branch extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'branches';

    protected $fillable = [
        'name',
        'slug',
        'address',
        'phones',
        'email',
        'active',
        'created_by',
        'updated_by',
        'com_code',
    ];

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



    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    protected $casts = ['active' => StatusActiveEnum::class];
}