<?php

namespace App\Http\Controllers;

use App\Services\Search\ImageSearchService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ImageSearchController
{


    protected $imageSearchService;

    public function __construct(ImageSearchService $imageSearchService)
    {
        $this->imageSearchService = $imageSearchService;
    }

    public function get(Request $request){
        $image = $request->file('image');
        $this->imageSearchService->setImage($image);
    }

    public function requestSimilarProducts(Request $request){
        $this->imageSearchService->requestUrlSimilarImages();
    }
}
