<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        "url",
        "alt"
    ];

    public function product()
    {
        return $this->hasOne(Product::class);
    }

    public function subImages()
    {
        return $this->hasMany(SubImage::class);
    }
}
