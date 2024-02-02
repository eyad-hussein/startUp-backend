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
        $productsIds = [1, 2, 3, 4, 5];

        $products = Product::with(['image', 'image.subimages', 'brand', 'product_sizes.size', 'reviews'])->find($productsIds);

        $formattedProducts = $products->map(function ($product) {
            $availableSizes = $product->product_sizes->pluck('size.size')->toArray();
            $reviews = $product->reviews->map(function ($review) {
                return [
                    "content" => $review->content,
                    "rating" => $review->rating,

                ];
            })->toArray();

            return [
                "id" => $product->id,
                "name" => $product->name,
                "price" => $product->price,
                "old_price" => $product->old_price,
                "description" => $product->description,
                "short_description" => $product->short_description,
                "image" => [
                    "id" => $product->image->id,
                    "url" => $product->image->url,
                    "subimages" => $product->image->subimages->map(function ($subimage) {
                        return [
                            $subimage->url,
                        ];
                    }),
                ],
                "brand" => [
                    "id" => $product->brand->id,
                    "name" => $product->brand->name,
                ],
                "available_sizes" => $availableSizes,
                "reviews" => $reviews,
            ];
        });

        return response([
            "products" => $formattedProducts,
        ]);
    }

}
