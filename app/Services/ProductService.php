<?php

namespace App\Services;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    // retrieve product with all its information
    // retrieve products with only their name and price and image

    public function showProduct(int $productId)
    {
        $product = Product::findOrFail($productId)->load('brand', 'image', 'sizes', 'reviews', 'image.subImages');

        return new ProductResource($product);
    }

    public function retrieveSearchResults(array $searchResults)
    {
        $productsIds = $searchResults['products'];
        $accuracies = $searchResults['accuracies'];

        // query the database to retrieve the products according to ids


        // return response()->json(['products' => $products, 'accuracies' => $accuracies]);
    }

    public function dummyProducts()
    {
        $productsIds = [1, 2, 3, 4, 5];
        $products = Product::findOrFail($productsIds)->load('brand', 'image', 'sizes', 'reviews', 'image.subImages', 'reviews.user');
        return response([
            'products' => $products,
        ]);
    }
}