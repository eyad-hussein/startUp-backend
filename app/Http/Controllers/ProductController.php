<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('image')->get();

        return response([
            "products" => $products,
        ]);
    }

    public function showMain()
    {
        $productsIds = [2, 3, 5, 4];
        $products = Product::with("image")->find($productsIds);

        return response([
            "products" => $products,
        ]);
    }
}
