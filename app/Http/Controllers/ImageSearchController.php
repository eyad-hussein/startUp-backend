<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Services\Search\ImageSearchService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
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
        $image = $request->file('image');

        $this->imageSearchService->setImage($image);

        $url = $this->imageSearchService->requestUrlSimilarImages();

        $productsArray = ProductService::getProductsFromUrl($url);

        $productsJson = json_encode($productsArray);

        return response()->json(['products' => $productsJson]);
    }
}
