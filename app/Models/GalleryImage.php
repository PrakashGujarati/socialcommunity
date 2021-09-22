<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'gallery_id',
        'path'
    ];

    public function getGalleryId()
    {
        return $this->belongsTo(Gallery::class, 'gallery_id');
    }
    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
