<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        "url",
        "alt"
    ];

    public function brand(): HasOne
    {
        return $this->hasOne(Brand::class);
    }

    public function subImages(): HasMany
    {
        return $this->hasMany(SubImage::class);
    }
}
