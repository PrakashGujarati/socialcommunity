<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $fillable = [

        'category',
        'event_title',
        'location',
        'description',
        'date',
        'status'

    ];
}
