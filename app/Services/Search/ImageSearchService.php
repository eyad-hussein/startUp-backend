<?php

namespace App\Services\Search;

use Illuminate\Support\Facades\Storage;
use App\Services\Search\FastApiService;
use App\Services\ProductService;

class ImageSearchService
{
    protected $fastApiService;
    protected $productService;
    protected $image;
    public function __construct(FastApiService $fastApiService, ProductService $productService)
    {
        $this->fastApiService = $fastApiService;
        $this->productService = $productService;
    }
    public function setImage(object $image)
    {
        $this->image = $image;
    }

    // what is the type of $image?
    public function requestSimilarProducts(object $image)
    {
        $this->setImage($image);
        $result = $this->fastApiService->retrieveSimilarImagesWithAccuracties($this->image);
        return $this->productService->retrieveProducts($result);
    }
}
