<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product\ProductCollection;
use App\Services\Search\ImageSearchService;
use Illuminate\Http\Request;

class ImageSearchController
{
    protected $imageSearchService;

    public function __construct(ImageSearchService $imageSearchService)
    {
        $this->imageSearchService = $imageSearchService;
    }

    public function requestSimilarProducts(Request $request)
    {
        $products = $this->imageSearchService->requestSimilarProducts($request->file('image'));
        return new ProductCollection($products);
    }
}
