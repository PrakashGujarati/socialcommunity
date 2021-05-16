<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'office',
        'category',
        'designation',
        'contact',
        'email',
        'address',
        'logo',
        'status',
        'done_by'
    ];
}
