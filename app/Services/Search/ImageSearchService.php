<?php

namespace App\Services\Search;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Services\Search\FastApiService;
use App\Services\ProductService;
use App\Services\S3StorageService;

class ImageSearchService
{
    protected $fastApiService;
    protected $productService;
    protected $s3StorageService;
    protected $image;
    public function __construct(FastApiService $fastApiService, ProductService $productService, S3StorageService $s3StorageService)
    {
        $this->fastApiService = $fastApiService;
        $this->productService = $productService;
        $this->$s3StorageService = $s3StorageService;
    }
    public function setImage(UploadedFile $image)
    {
        $this->image = $image;
    }

    // what is the type of $image?
    public function requestSimilarProducts(UploadedFile $image)
    {
        $this->setImage($image);
        $category = $this->fastApiService->requestCategoryOfProduct($this->image);

        $vectorRepresentationsOfCategoryWithProductIds = $this->productService->retrieveVectorRepresentationsOfCategory($category);
        $similarProducts = $this->fastApiService->requestSimilarProducts($vectorRepresentationsOfCategoryWithProductIds);
        $productsWithAccuracies = $this->s3StorageService->retrieveProductsWithAccuracies($similarProducts);
        return $productsWithAccuracies;
    }

    public function requestSimilarProductsFromUrl(string $url){
        $image = $this->s3StorageService->getImage($url);
        $this->s3StorageService->emptyFolder('/temp');
        $productsWithAccuracies = $this->requestSimilarProducts($image);
        return $productsWithAccuracies;
    }

}

