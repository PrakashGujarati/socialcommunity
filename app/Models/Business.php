<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'company',
        'category',
        'description',
        'contact',
        'email',
        'address',
        'logo',
        'visitingcard',
        'status',
        'done_by'
    ];
}
