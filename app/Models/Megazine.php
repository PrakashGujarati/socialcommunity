<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Megazine extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'category',
        'date',
        'path',
        'resized_images',
        'status'        
    ];
}
