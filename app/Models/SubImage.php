<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubImage extends Model
{
    use HasFactory;

    protected $fillable = ['image_id', 'url'];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
