<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'device_id',
        'user_id',
        'title',
        'image',
        'message'
    ];

    // public function getUserId(){
    //     return $this->belongsTo(User::class , 'user_id');
    // }
}
