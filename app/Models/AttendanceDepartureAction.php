<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceDepartureAction extends Model
{
    use HasFactory;

    protected $table = 'attendance_departure_action_excels';

    protected $fillable = [];

   // public function {{name}}()
    // {
    //     return $this->belongsTo({{model}}::class, {{culomn}});
    // }
}