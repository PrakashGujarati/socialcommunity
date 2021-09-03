<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Late extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'late_date',
        'birth_date',
        'gujarati_savant',
        'address',
        'shradhhanjali',
        'notifications',
        'contact',
        'picture',
        'status',
        'done_by'
    ];
}
