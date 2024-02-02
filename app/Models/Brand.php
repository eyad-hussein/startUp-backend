<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\StoreProductRequest;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }


    // -------------------------------
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request, Brand $brand)
    {

        $brand->products()->create($request->validated());

        return response([
            "message" => "Product created successfully",
        ]);
    }
}
