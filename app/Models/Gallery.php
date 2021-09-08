<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\galleryImages;

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

    public function galleryImages()
    {
        return $this->hasMany(GalleryImage::class, 'gallery_id');
    }
}
