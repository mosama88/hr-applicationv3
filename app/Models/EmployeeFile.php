<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class EmployeeFile extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $table = 'employee_files';

    protected $fillable = [
        'employee_id',
        'file_name',
        'com_code',
        'created_by',
        'updated_by',
    ];



    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }



    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
