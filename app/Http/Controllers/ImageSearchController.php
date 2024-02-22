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
        $productsWithAccuracies = $this->imageSearchService->requestSimilarProducts($request->image);
        return response(
            [
                'products' => $productsWithAccuracies,
            ]
        );
    }
}
