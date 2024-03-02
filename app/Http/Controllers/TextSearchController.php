<?php

namespace App\Http\Controllers;

use App\Services\Search\TextSearchService;
use Illuminate\Http\Request;

class TextSearchController
{
    protected $textSearchService;
    public function __construct(TextSearchService $textSearchService)
    {
        $this->textSearchService = $textSearchService;
    }

    public function requestSimilarImages(Request $request)
    {
        $description = $request['text'];
        return response(["urls"=>$this->textSearchService->requestSimilarImages($description)],200);
    }


}
