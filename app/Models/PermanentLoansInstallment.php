<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermanentLoansInstallment extends Model
{
    use HasFactory;

    protected $table = 'permanent_loans_installments';

    protected $fillable = [];

   // public function {{name}}()
    // {
    //     return $this->belongsTo({{model}}::class, {{culomn}});
    // }
}