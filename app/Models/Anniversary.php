<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anniversary extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'marriagedate',
        'time',
        'place',
        'wishes',
        'picture',
        'status'
    ];
}
