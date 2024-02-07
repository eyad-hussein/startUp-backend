<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SearchService;

class SearchController extends Controller
{
    private $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function retrieveSimilarRecords(Request $request)
    {
        return $this->searchService->retrieveSimilarRecords($request);
    }

}
