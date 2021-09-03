<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    use HasFactory;
    protected $fillable = [
        'headline',
        'title',
        'category',
        'description',
        'skills',
        'education_quailification',
        'thumbnail',
        'reference_url',
        'reported_datetime',
        'status',
        'done_by'
    ];
}
