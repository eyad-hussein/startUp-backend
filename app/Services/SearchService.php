<?php

namespace App\Services;

use Illuminate\Http\Request;


class SearchService
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function retrieveSimilarRecords(Request $request)
    {

        // call fastapi to retrieve similar records and return them as a list of products using the product service
        return $this->productService->retrieveSearchResults([]);
    }
}