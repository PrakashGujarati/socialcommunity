<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = [
        'headline',
        'title',
        'category',
        'detail_report',
        'thumbnail',
        'news_image',
        'reported_datetime',
        'reference',
        'status',
        'done_by'
    ];
}
