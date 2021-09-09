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
<<<<<<< HEAD

=======
               
>>>>>>> 108a772e84dbc581f25c6e38faaed58d89eb67b5
    ];
    public function getGalleryId()
    {
        return $this->belongsTo(Gallery::class,'gallery_id');
    }
}
