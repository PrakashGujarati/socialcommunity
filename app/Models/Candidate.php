<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'birth_date',
        'birth_time',
        'birth_place',
        'height',
        'weight',
        'education',
        'occupation',
        'father_name',
        'mother_name',
        'brothers',
        'sisters',
        'father_occupation',
        'mother_occupation',
        'father_contact',
        'contact',
        'email',
        'resident_address',
        'native_address',
        'maternal',
        'maternal_place',
        'hobbies',
        'expectations',
        'remark',
        'picture',
        'status',
        'done_by'
    ];
}
