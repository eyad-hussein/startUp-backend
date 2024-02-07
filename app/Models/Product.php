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
        "price",
        "old_price",
        "image_id",
        "brand_id",
        "description",
        "short_description",
    ];
    public function image()
    {
        return $this->belongsTo(Image::class);
    }
    public function subImages()
    {
        return $this->hasMany(Subimage::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class);
    }
}
