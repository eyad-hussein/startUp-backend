<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "slug",
        "brand",
        "price",
        "old_price",
        "image_id",
    ];
    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
