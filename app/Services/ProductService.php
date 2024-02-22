<?php

namespace App\Services;

use App\Http\Resources\Product\ProductResource;
use App\Enums\CategoryEnum;
use App\Models\Category;
use App\Models\Product;
use App\Models\VectorRepresentation;
use Illuminate\Support\Collection;
use App\Services\Search\FastApiService;

class ProductService
{

    protected $s3StorageService;
    protected $fastApiService;

    public function __construct(S3StorageService $s3StorageService, FastApiService $fastApiService)
    {
        $this->s3StorageService = $s3StorageService;
        $this->fastApiService = $fastApiService;
    }
    // retrieve product with all its information
    // retrieve products with only their name and price and image
    public function showProduct(int $productId)
    {
        $product = Product::findOrFail($productId)->load('brand', 'image', 'sizes', 'reviews', 'image.subImages');

        return new ProductResource($product);
    }

    public function storeProduct(array $request)
    {
        $product = new Product();

        $product->name = $request['name'];
        $product->price = $request['price'];
        $product->description = $request['description'];
        $product->stock = $request['stock'];

        if (isset($request['is_active'])) {
            $product->is_active = $request['is_active'];
        }

        $product->brand_id = $request['brand_id'];
        $product->category_id = Category::query()->where('name', $this->fastApiService->requestCategoryOfProduct($request['images']['thumbnail'])->value)->first()->id;

        $vectorRepresentation1 = new VectorRepresentation();
        $vectorRepresentation1->vector = $this->fastApiService->convertToVector($request['images']['thumbnail']);
        $vectorRepresentation1->product_id = $product->id;

        $vectorRepresentation2 = new VectorRepresentation();
        $vectorRepresentation2->vector = $this->fastApiService->convertToVector($request['images']['thumbnail']);
        $vectorRepresentation2->product_id = $product->id;

        $path = "categories/" . $product->category->name . "/" . $product->brand->name . "/" . $product->id;
        $product->meta_data_url = $this->s3StorageService->storeMetaData($product->id, $path, $request['images']);

        $product->save();
    }

    public function retrieveVectorRepresentationsOfCategory(CategoryEnum $categoryEnum): Collection
    {
        $category = Category::where('name', $categoryEnum->value)->first();

        $vectorRepresentations = VectorRepresentation::select('vector', 'product_id')
            ->join('products', 'vector_representations.product_id', '=', 'products.id')
            ->where('products.category_id', $category->id)
            ->get();

        return $vectorRepresentations;
    }
}
