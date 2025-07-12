<?php

namespace App\Models;

use App\Enums\AdminGenderEnum;
use App\Enums\AdminStatusEnum;
use App\Enums\StatusActiveEnum;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasSlug;

    protected $table = 'admins';

    protected $fillable = [
        'name',
        'slug',
        'username',
        'email',
        'email_verified_at',
        'password',
        'mobile',
        'active',
        'created_by',
        'updated_by',
        'gender',
        'com_code',
        'remember_token'
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $casts = [
        'active' => StatusActiveEnum::class,
        'gender' => AdminGenderEnum::class,
    ];
}