<?php

namespace App\Services;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

class ProductService
{
    // retrieve product with all its information
    // retrieve products with only their name and price and image

    public function showProduct(int $productId)
    {
        $product = Product::findOrFail($productId)->load('brand', 'image', 'sizes', 'reviews', 'image.subImages');

        return new ProductResource($product);
    }

    public function retrieveProducts(array $result)
    {
        $productsWithAccuracies = [
            "products" => [],
            "accuracies" => [],
        ];

        foreach ($result['images'] as $image) {
            $product = $this->getProductFromUrl($image['url']);
            array_push($productsWithAccuracies['products'], $product);
            array_push($productsWithAccuracies['accuracies'], $image['accuracy']);
        }

        return $productsWithAccuracies;
    }

    public static function getProductFromUrl(string $url)
    {
        $product = Product::whereHas('image', function ($query) use ($url) {
            $query->where('url', $url);
        })->first()->load('brand', 'image', 'sizes', 'reviews', 'image.subImages', 'reviews.user');

        return $product;
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
